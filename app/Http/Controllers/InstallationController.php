<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class InstallationController extends Controller
{
    private $requiredExtensions = [
        'bcmath', 'ctype', 'json', 'mbstring', 'openssl', 'PDO', 'tokenizer', 'xml', 'xmlwriter', 'curl', 'fileinfo', 'zip',
    ];

    public function install()
    {
        $envFilePath = base_path('.env');
        $isWritable = is_writable($envFilePath);
        $permissionRecommendation = $isWritable ? null : $this->generatePermissionRecommendation($envFilePath);
        $missingExtensions = array_filter($this->requiredExtensions, fn ($extension) => !extension_loaded($extension));

        return view('install', compact('missingExtensions', 'isWritable', 'permissionRecommendation'));
    }

    public function processInstall(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'app_name' => 'required',
            'db_host' => 'required',
            'db_port' => 'required|numeric',
            'db_database' => 'required',
            'db_username' => 'required',
            'db_password' => 'required',
            'admin_name' => 'required',
            'admin_password' => 'required',
            'admin_email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $this->changeEnv([
                'DB_HOST' => $request->db_host,
                'DB_PORT' => $request->db_port,
                'DB_DATABASE' => $request->db_database,
                'DB_USERNAME' => $request->db_username,
                'DB_PASSWORD' => $request->db_password,
            ]);

            DB::connection()->getPdo();
            Artisan::call('migrate');
            $user = new User();
            $user->name = $request->admin_name;
            $user->password = Hash::make($request->admin_password);
            $user->email = $request->admin_email;
            $user->save();

            if (empty(env('APP_KEY')) || substr(env('APP_KEY'), -3) === '00=') {
                Artisan::call('key:generate');
            }

            $this->changeEnv([
                'APP_NAME' => $request->app_name,
                'APP_URL' => $request->getSchemeAndHttpHost(),
                'APP_SPA_URL' => $request->app_spa_url,
                'APP_INSTALLED' => 'true',
                'APP_ENV' => 'staging',
                'APP_DEBUG' => 'false',
            ]);

            return redirect('/');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }

    protected function changeEnv($data = [])
    {
        if (count($data) > 0) {
            $env = file_get_contents(base_path('.env'));

            foreach ($data as $key => $value) {
                $env = preg_replace("/^{$key}=.*/m", "{$key}={$value}", $env);
            }

            $envUpdate = file_put_contents(base_path('.env'), $env);

            return $envUpdate !== false;
        }

        return false;
    }

    private function generatePermissionRecommendation($filePath)
    {
        $path = dirname($filePath);
        $command = "chmod -R 755 {$path} && chown -R www-data:www-data {$path}";

        return "You can try this command to grant write permission:<br /> <code>{$command}</code>";
    }
}
