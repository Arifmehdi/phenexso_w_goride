<?php

namespace Database\Seeders;

use App\Models\BlogPost;
use App\Models\Department;
use App\Models\FrontSlider;
use App\Models\PageContent;
use App\Models\Testimonial;
use App\Models\BlogCategory;
use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Update Home Page Content
        $home = PageContent::where('page_slug', 'home')->first();
        if ($home) {
            $home->update([
                'title_bn' => 'নির্ভরযোগ্য গাড়ি ভাড়া সারা বাংলাদেশে',
                'subtitle_bn' => 'ব্যক্তি, কর্পোরেট এবং ট্যুর গ্রুপের জন্য শীর্ষস্থানীয় ট্রান্সপোর্ট মার্কেটপ্লেস।',
                'description_bn' => 'গো-রাইড বাংলাদেশ অ্যাপ ডাউনলোড করুন এবং রাইড বুক করুন, ড্রাইভার ট্র্যাক করুন, নিরাপদে পেমেন্ট করুন এবং আপনার সব ট্রিপ পরিচালনা করুন — এক জায়গায়।',
            ]);
            
            // Update meta if it exists
            $meta = $home->meta;
            if (is_string($meta)) {
                $meta = json_decode($meta, true);
            }

            if (is_array($meta)) {
                $meta_bn = $meta;
                $meta_bn['hero_title'] = 'নির্ভরযোগ্য গাড়ি ভাড়া';
                $meta_bn['hero_span'] = 'সারা বাংলাদেশে';
                $meta_bn['hero_badge'] = 'সারাদেশে ৫,০০০+ গ্রাহকের বিশ্বস্ত';
                $meta_bn['hero_subtitle'] = 'ব্যক্তি, কর্পোরেট এবং ট্যুর গ্রুপের জন্য শীর্ষস্থানীয় ট্রান্সপোর্ট মার্কেটপ্লেস।';
                $meta_bn['hero_cta_text'] = 'রাইড বুক করুন';
                
                $home->meta_bn = $meta_bn;
                $home->save();
            }
        }

        // 2. Update Testimonials
        $testimonials = Testimonial::all();
        foreach ($testimonials as $testimonial) {
            if ($testimonial->name == 'Rahim Sarkar') {
                $testimonial->update([
                    'designation_bn' => 'ঢাকা',
                    'text_bn' => 'ভোর ৪টায় এয়ারপোর্টের জন্য একটি রাইড বুক করেছিলাম এবং ড্রাইভার ৫ মিনিট আগেই চলে এসেছিলেন। অ্যাপটি ব্যবহার করা খুবই সহজ ছিল।',
                ]);
            } elseif ($testimonial->name == 'Farida Hossain') {
                $testimonial->update([
                    'designation_bn' => 'এইচআর ম্যানেজার, চট্টগ্রাম',
                    'text_bn' => 'আমাদের কোম্পানি সব এক্সিকিউটিভ ট্রান্সপোর্ট প্রয়োজনের জন্য গো-রাইড ব্যবহার করছে। কর্পোরেট ড্যাশবোর্ড এবং মাসিক ইনভয়েসিং আমাদের অনেক সময় বাঁচিয়েছে।',
                ]);
            } elseif ($testimonial->name == 'Karim Ahmed') {
                $testimonial->update([
                    'designation_bn' => 'সিলেট',
                    'text_bn' => 'কক্সবাজার ট্যুর প্যাকেজটি অবিশ্বাস্য ছিল। আরামদায়ক গাড়ি, অভিজ্ঞ ড্রাইভার যিনি সব সেরা জায়গা চিনতেন। আমাদের পারিবারিক ট্রিপের জন্য অবশ্যই আবার বুক করব।',
                ]);
            }
        }

        // 3. Update Blog Categories
        $categories = BlogCategory::all();
        foreach ($categories as $cat) {
            if ($cat->name == 'Health') {
                $cat->update(['name_bn' => 'স্বাস্থ্য']);
            } elseif ($cat->name == 'News') {
                $cat->update(['name_bn' => 'সংবাদ']);
            }
        }

        // 4. Update Blog Posts
        $posts = BlogPost::all();
        foreach ($posts as $post) {
            if (str_contains($post->title, 'Lactose Intolerance')) {
                $post->update([
                    'title_bn' => 'ল্যাকটোজ ইনটলারেন্স: দুগ্ধজাত খাবার গ্রহণে চ্যালেঞ্জ',
                    'excerpt_bn' => 'ল্যাকটোজ ইনটলারেন্স হল একটি সাধারণ হজমজনিত ব্যাধি যা ল্যাকটোজ ভেঙে ফেলার অক্ষমতার কারণে ঘটে...',
                ]);
            }
        }

        // 5. Update Sliders
        $sliders = FrontSlider::all();
        foreach ($sliders as $slider) {
            if ($slider->title) {
                $slider->update([
                    'title_bn' => 'বাংলা স্লাইডার টাইটেল',
                    'description_bn' => 'স্লাইডারের বিস্তারিত বর্ণনা এখানে থাকবে।',
                ]);
            }
        }
    }
}
