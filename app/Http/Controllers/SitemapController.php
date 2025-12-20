<?php

namespace App\Http\Controllers;

class SitemapController extends Controller
{
    public function index()
    {
        $sitemap = '<?xml version="1.0" encoding="UTF-8"?>';
        $sitemap .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

        // Landing Page
        $sitemap .= '<url>';
        $sitemap .= '<loc>'.config('app.url').'/'.'</loc>';
        $sitemap .= '<lastmod>'.now()->toAtomString().'</lastmod>';
        $sitemap .= '<changefreq>weekly</changefreq>';
        $sitemap .= '<priority>1.0</priority>';
        $sitemap .= '</url>';

        // Login Page
        $sitemap .= '<url>';
        $sitemap .= '<loc>'.route('login').'</loc>';
        $sitemap .= '<lastmod>'.now()->toAtomString().'</lastmod>';
        $sitemap .= '<changefreq>monthly</changefreq>';
        $sitemap .= '<priority>0.8</priority>';
        $sitemap .= '</url>';

        // Register Page
        $sitemap .= '<url>';
        $sitemap .= '<loc>'.route('register').'</loc>';
        $sitemap .= '<lastmod>'.now()->toAtomString().'</lastmod>';
        $sitemap .= '<changefreq>monthly</changefreq>';
        $sitemap .= '<priority>0.8</priority>';
        $sitemap .= '</url>';

        // Panduan Page
        $sitemap .= '<url>';
        $sitemap .= '<loc>'.route('guide').'</loc>';
        $sitemap .= '<lastmod>'.now()->toAtomString().'</lastmod>';
        $sitemap .= '<changefreq>monthly</changefreq>';
        $sitemap .= '<priority>0.7</priority>';
        $sitemap .= '</url>';

        // Panduan Lengkap Page (Digital Guide)
        $sitemap .= '<url>';
        $sitemap .= '<loc>'.route('guide.view').'</loc>';
        $sitemap .= '<lastmod>'.now()->toAtomString().'</lastmod>';
        $sitemap .= '<changefreq>monthly</changefreq>';
        $sitemap .= '<priority>0.8</priority>';
        $sitemap .= '</url>';

        $sitemap .= '</urlset>';

        return response($sitemap, 200)
            ->header('Content-Type', 'application/xml');
    }

    public function robots()
    {
        $robots = "User-agent: *\n";
        $robots .= "Allow: /\n";
        $robots .= "Disallow: /admin/\n";
        $robots .= "Disallow: /student/\n";
        $robots .= "\n";
        $robots .= 'Sitemap: '.url('/sitemap.xml')."\n";

        return response($robots, 200)
            ->header('Content-Type', 'text/plain');
    }
}
