<?php

namespace App\Providers;

use App\Actions\Fortify\AuthenticateUser;
use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use App\Models\User;
use App\Services\AuthService;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Laravel\Fortify\Fortify;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        RateLimiter::for('login', function (Request $request) {
            $throttleKey = Str::transliterate(Str::lower($request->input(Fortify::username())) . '|' . $request->ip());

            return Limit::perMinute(5)->by($throttleKey);
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });

        Fortify::loginView(function () {
            return view('login');
        });

        Fortify::authenticateUsing(function ($request) {
            return (new AuthenticateUser())->handle($request);
        });

        // Fortify::authenticateUsing(function (Request $request) {
        //     $request->validate([
        //         'npk' => ['required', 'string'],
        //         'password' => ['required', 'string'],
        //         'captcha' => ['required', 'captcha', 'digits:5'],
        //     ]);

        //     // Periksa apakah captcha yang diinput user sesuai dengan yang ada di session
        //     if ($request->captcha != session('captcha')) {
        //         throw ValidationException::withMessages([
        //             'captcha' => ['Captcha yang dimasukkan salah.'],
        //         ]);
        //     }

        //     $user = User::where('npk', $request->npk)->first();

        //     if ($user && Hash::check($request->password, $user->password)) {
        //         if ($user->two_factor_secret) {
        //             session(['show_otp_modal' => true, 'user_id' => $user->id]);
        //         }

        //         return $user;
        //     }

        //     throw ValidationException::withMessages([
        //         'npk' => ['NPK atau password salah.'],
        //     ]);
        // });




        // Override tampilan OTP agar muncul modal
        Fortify::twoFactorChallengeView(function () {
            session(['show_otp_modal' => true]);
            return view('two-factor');
        });
    }
}
