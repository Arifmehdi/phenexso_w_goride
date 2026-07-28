<?php

use App\Models\Cart;
use App\Services\NotificationService;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

if (!function_exists('notify')) {
    /**
     * Central notification helper — call from anywhere:
     *   notify()->toDriver($driver, 'Approved', 'You can now go online');
     *   notify()->toAllUsers('Eid Offer', '20% off all rides!');
     *   notify()->toEveryone('Maintenance', 'App will be down at 2 AM');
     */
    function notify(): NotificationService
    {
        return app(NotificationService::class);
    }
}

if (!function_exists('notificationAudience')) {
    /**
     * Map an authenticated model to its notification audience.
     * Each entity lives in its own table, so the audience disambiguates
     * the shared numeric id space (User #5 != Driver #5 != Corporate #5).
     */
    function notificationAudience($model): string
    {
        return match (true) {
            $model instanceof \App\Models\Driver    => 'driver',
            $model instanceof \App\Models\Corporate => 'corporate',
            $model instanceof \App\Models\Admin     => 'admin',
            default                                 => 'user', // App\Models\User (customer/passenger/owner)
        };
    }
}

if (!function_exists('notificationQueryFor')) {
    /**
     * Audience-aware notifications query for a given entity.
     * Shows broadcasts for their audience (+ 'all') and their personal notifications.
     */
    function notificationQueryFor($user)
    {
        $audience = notificationAudience($user);

        return \App\Models\Notification::where(function ($q) use ($user, $audience) {
            // Broadcasts for this audience (or everyone)
            $q->where(function ($qq) use ($audience) {
                $qq->where('all_show', 1)->whereIn('recipient_type', ['all', $audience]);
            });
            // Personal notifications (must match BOTH id and audience)
            if ($user) {
                $q->orWhere(function ($qq) use ($user, $audience) {
                    $qq->where('user_id', $user->id)->where('recipient_type', $audience);
                });
            }
        });
    }
}

if (!function_exists('unreadNotificationCount')) {
    /** Unread personal notifications for the header bell badge. */
    function unreadNotificationCount(): int
    {
        $user = currentUser();
        if (!$user) return 0;
        return \App\Models\Notification::where('user_id', $user->id)
            ->where('recipient_type', notificationAudience($user))
            ->where('is_read', 0)
            ->count();
    }
}

/**
 * Return sizes readable by humans
 */
function human_filesize($bytes, $decimals = 2)
{
  $size = ['B', 'kB', 'MB', 'GB', 'TB', 'PB'];
  $factor = floor((strlen($bytes) - 1) / 3);

  return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) .
      @$size[$factor];
}




function menuSubmenu($menu, $submenu)
{
  $request = request();
  $request->session()->forget(['lsbm','lsbsm']);
  $request->session()->put(['lsbm'=>$menu,'lsbsm'=>$submenu]);
  return true;
}




function bdMobile($mobile)
{
    $number = trim($mobile);
    $c_code = '880';
    $cc_count = strlen($c_code);

    if(substr($number, 0, 2) == '00')
    {
        $number = ltrim($number, '0');
    }
    if(substr($number, 0, 1) == '0')
    {
        $number = ltrim($number, '0');
    }
    if(substr($number, 0, 1) == '+')
    {
        $number = ltrim($number, '+');
    }
    if(substr($number, 0, $cc_count) == $c_code)
    {
        $number = substr($number, $cc_count);
    }
    if(substr($c_code, -1) == 0)
    {
        $number = ltrim($number, '0');
    }
    $finalNumber = $c_code.$number;

    return $finalNumber;
}



function smsUrl($to, $msg)
{
    $userid = 'bisesoggo.test';
    $password = '11112222';
    $sender = '01970009329';

    return "http://apismpp.ajuratech.com/sendtext?apikey=62319aab9168d33a&secretkey=a95fe3da&callerID={$sender}&toUser={$to}&messageContent={$msg}";
}


function intMobile($cc,$mobile)
{
    $number = trim($mobile);
    $c_code = $cc;
    $cc_count = strlen($c_code);

    if(substr($number, 0, 2) == '00')
    {
        $number = ltrim($number, '0');
    }
    if(substr($number, 0, 1) == '0')
    {
        $number = ltrim($number, '0');
    }
    if(substr($number, 0, 1) == '+')
    {
        $number = ltrim($number, '+');
    }
    if(substr($number, 0, $cc_count) == $c_code)
    {
        $number = substr($number, $cc_count);
    }
    if(substr($c_code, -1) == 0)
    {
        $number = ltrim($number, '0');
    }
    $finalNumber = $c_code.$number;

    return $finalNumber;



}




function getSlug($title = Null, $model = Null, $edit = false)
{
  if (!is_null($title)) {
    $slug = "";
    if (!preg_match('/[^\x20-\x7e]/', $title)) {
      $slug = Str::slug($title);
    }
    $slug = empty($slug) ? generateSlug($title) : $slug;
    if (!$model == Null) {
      $exixts = $model->where('slug', $slug)->get();
      if (count($exixts) > 0 && !$edit) {
        $slug = $slug . '-' . time();
      }
    }
    return $slug;
  } else {
    return time();
  }
}
/**
 * Generate Slug NUmber For All Language
 */
function generateSlug($title, $seperator = '-')
{
  $title = str_replace(['- ', ' -', ' '], $seperator, $title);
  $title = str_replace('@', 'AT', $title);
  $title = strip_tags($title);
  return trim($title);
}

function currentUser()
{
    foreach (['web', 'admin', 'driver', 'corporate'] as $guard) {
        if (Auth::guard($guard)->check()) {
            return Auth::guard($guard)->user();
        }
    }
    return null;
}



if (!function_exists('sidebarOpen')) {
    /**
     * Returns AdminLTE's ' menu-open ' when the current request matches any of
     * the given route-name patterns (e.g. 'admin.ride-ops.*').
     *
     * The sidebar's original highlighting relies on session('lsbm'), which a
     * controller must set by calling menuSubmenu(). Pages that don't call it
     * simply never highlight. This derives the state from the URL instead, so
     * it always works; it is used ALONGSIDE the session checks, never
     * replacing them.
     */
    function sidebarOpen(...$patterns): string
    {
        foreach ($patterns as $p) {
            if (request()->routeIs($p)) return ' menu-open ';
        }
        return '';
    }
}

if (!function_exists('sidebarActive')) {
    /** Same as sidebarOpen(), but returns ' active ' for the link itself. */
    function sidebarActive(...$patterns): string
    {
        foreach ($patterns as $p) {
            if (request()->routeIs($p)) return ' active ';
        }
        return '';
    }
}
