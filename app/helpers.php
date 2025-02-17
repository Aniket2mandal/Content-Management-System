<?php

use Illuminate\Support\Facades\Log;


// FOR TESTIMONIAL 

if (!function_exists('getLatestTestimonials')) {
    function getLatestTestimonials()
    {
        $filePath = storage_path('app/bhitta.json');

        if (!file_exists($filePath)) {
            return [];
        }

        // Read the JSON file
        $jsonData = json_decode(file_get_contents($filePath), true);

        // Get limit from JSON file (default to 5 if not set)
        // $limit = $jsonData['limit'] ?? 5;

        // Get only published testimonials
        $testimonials = array_filter($jsonData['testimonials'], function ($testimonial) {
            // return $testimonial['published'] === "1";
            return $testimonial;
        });

        // Sort testimonials by latest (assuming latest is last in the array)
        $testimonials = array_reverse($testimonials);

        // Return only the limited number of testimonials
        // return array_slice($testimonials, 0, $limit);
        return array_slice($testimonials, 0);
    }
}

if (!function_exists('saveTestimonials')) {
    function saveTestimonials($newTestimonial)
    {
        $filePath = storage_path('app/bhitta.json');

        // Read existing data or initialize JSON structure
        $jsonData = file_exists($filePath) ? json_decode(file_get_contents($filePath), true) : ['testimonials' => [], 'limit' => 5];

        // Add the new testimonial
        $newTestimonial['id'] = count($jsonData['testimonials']) + 1;
        $jsonData['testimonials'][] = $newTestimonial;

        // Save updated data back to JSON file
        file_put_contents($filePath, json_encode($jsonData, JSON_PRETTY_PRINT));
    }
}


if (!function_exists('editTestimonial')) {
    function editTestimonials($newTestimonial)
    {
        $filePath = storage_path('app/bhitta.json');
        $jsonData = file_exists($filePath) ? json_decode(file_get_contents($filePath), true) : ['testimonials' => [], 'limit' => 5];
        // $found = false;
        foreach ($jsonData['testimonials'] as &$testimonial) {
            if ($testimonial['id'] == $newTestimonial['id']) {
                // $testimonial['published'] = $newTestimonialStatus['published'];
                return $testimonial;
                // $found=true;
                break;
            }
        }
        // file_put_contents($filePath, json_encode($jsonData, JSON_PRETTY_PRINT));
        return null;
    }
}


if (!function_exists('updateTestimonials')) {
    function updateTestimonials($newTestimonial)
    {
        // Log::info('Updating testimonial with ID: ' . $newTestimonial['id']);
        $filePath = storage_path('app/bhitta.json');
        $jsonData = file_exists($filePath) ? json_decode(file_get_contents($filePath), true) : ['testimonials' => [], 'limit' => 5];

        $found = false; // Initialize found flag
        foreach ($jsonData['testimonials'] as &$testimonial) {
            if ($testimonial['id'] == $newTestimonial['id']) {
                 if($newTestimonial['image']){
                $testimonial = $newTestimonial;
              
                 }
                 else{
                 $testimonial['name']=$newTestimonial['name'];
                 $testimonial['message']=$newTestimonial['message'];
                 $testimonial['image']=$testimonial['image'];
                 $testimonial['published']=$newTestimonial['published'];
                 }
                 $found = true;
                 break;
            }
        }

        if ($found) {
            // Save changes to the file
            $saveResult = file_put_contents($filePath, json_encode($jsonData, JSON_PRETTY_PRINT));

            if ($saveResult === false) {
                return 'Error saving the file';
            }
        }

        return $found ? true : 'Testimonial not found';
    }
}




if (!function_exists('updateTestimonialsStatus')) {
    function updateTestimonialsStatus($newTestimonialStatus)
    {
        $filePath = storage_path('app/bhitta.json');
        $jsonData = file_exists($filePath) ? json_decode(file_get_contents($filePath), true) : ['testimonials' => [], 'limit' => 5];
        $found = false;
        foreach ($jsonData['testimonials'] as &$testimonial) {
            if ($testimonial['id'] == $newTestimonialStatus['id']) {
                $testimonial['published'] = $newTestimonialStatus['published'];
                $found = true;
                break;
            }
        }
        file_put_contents($filePath, json_encode($jsonData, JSON_PRETTY_PRINT));
        return $found;
    }
}

if (!function_exists('deleteTestimonials')) {
    function deleteTestimonials($newTestimonial)
    {
        $filePath = storage_path('app/bhitta.json');
        $jsonData = file_exists($filePath) ? json_decode(file_get_contents($filePath), true) : ['testimonials' => [], 'limit' => 5];
        $found = false;
        foreach ($jsonData['testimonials'] as $key => &$testimonial) {
            if ($testimonial['id'] == $newTestimonial['id']) {
                // $testimonial['published'] = $newTestimonialStatus['published'];
                unset($jsonData['testimonials'][$key]);
                $found = true;
                break;
            }
        }
        file_put_contents($filePath, json_encode($jsonData, JSON_PRETTY_PRINT));
        return $found;
    }
}
