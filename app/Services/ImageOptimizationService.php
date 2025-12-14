<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class ImageOptimizationService
{
    protected $manager;

    public function __construct()
    {
        $this->manager = new ImageManager(new Driver);
    }

    /**
     * Optimize and store image with smart resizing
     *
     * @param  int  $maxWidth  Maximum width (default: 1920px for high quality)
     * @param  int  $quality  Quality percentage (default: 90% for minimal loss)
     * @return string Path to stored file
     */
    public function optimizeAndStore(
        UploadedFile $file,
        string $directory,
        int $maxWidth = 1920,
        int $quality = 90
    ): string {
        // Generate unique filename
        $extension = $file->getClientOriginalExtension();
        $filename = Str::random(40).'.'.$extension;
        $path = $directory.'/'.$filename;

        // Read image
        $image = $this->manager->read($file->getRealPath());

        // Get original dimensions
        $originalWidth = $image->width();
        $originalHeight = $image->height();

        // Only resize if image is larger than max width
        if ($originalWidth > $maxWidth) {
            // Calculate new height to maintain aspect ratio
            $newHeight = (int) (($maxWidth / $originalWidth) * $originalHeight);

            // Resize with high quality
            $image->scale(width: $maxWidth, height: $newHeight);
        }
        // If image is smaller than maxWidth, keep original size (no upscaling)

        // Encode with specified quality
        $encoded = $image->toJpeg(quality: $quality);

        // Store to disk
        Storage::disk('public')->put($path, (string) $encoded);

        return $path;
    }

    /**
     * Optimize photo specifically (4x6 ratio, smaller max width)
     */
    public function optimizePhoto(UploadedFile $file, string $directory): string
    {
        // For photos, use smaller max width (800px is enough for 4x6 display)
        // Quality 85% is perfect balance between size and quality
        return $this->optimizeAndStore($file, $directory, maxWidth: 800, quality: 80);
    }

    /**
     * Optimize document scan (KTP, KK, Ijazah)
     */
    public function optimizeDocument(UploadedFile $file, string $directory): string
    {
        // For documents, keep higher resolution for readability
        // Quality 90% to preserve text clarity
        return $this->optimizeAndStore($file, $directory, maxWidth: 1920, quality: 80);
    }

    /**
     * Delete old image file
     */
    public function deleteOldImage(?string $path): bool
    {
        if ($path && Storage::disk('public')->exists($path)) {
            return Storage::disk('public')->delete($path);
        }

        return false;
    }

    /**
     * Get optimized image info
     */
    public function getImageInfo(string $path): array
    {
        if (! Storage::disk('public')->exists($path)) {
            return [];
        }

        $fullPath = Storage::disk('public')->path($path);
        $image = $this->manager->read($fullPath);

        return [
            'width' => $image->width(),
            'height' => $image->height(),
            'size' => Storage::disk('public')->size($path),
            'size_kb' => round(Storage::disk('public')->size($path) / 1024, 2),
            'mime_type' => Storage::disk('public')->mimeType($path),
        ];
    }
}
