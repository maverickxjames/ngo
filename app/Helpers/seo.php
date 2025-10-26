<?php 

if (!function_exists('seoDefaults')) {
    function seoDefaults($title = null, $desc = null, $keywords = null)
    {
        return [
            'title' => $title ?? 'Akshardan Foundation – Empowering Lives',
            'description' => $desc ?? 'Join Akshardan Foundation in uplifting underprivileged lives in Ujjain, Madhya Pradesh.',
            'keywords' => $keywords ?? 'Akshardan Foundation, NGO, Charity, Donate, Ujjain',
            'image' => asset('https://mobflix.s3.ap-south-1.amazonaws.com/cdn/akshardan/default-og.png'),
            'url' => url()->current(),
            'type' => 'website',
            'favicon' => asset('https://mobflix.s3.ap-south-1.amazonaws.com/cdn/akshardan/favicon.ico'),
        ];
    }
}
