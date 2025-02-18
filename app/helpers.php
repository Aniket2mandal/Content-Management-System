<?php

use Illuminate\Support\Facades\Log;





if (!function_exists('initializeBhittaConfig')) {
    function initializeBhittaConfig()
    {
        // $testFile = storage_path('app/test.txt');
        // file_put_contents($testFile, 'Test content');
        // Log::info('Test file written at: ' . $testFile);

        
        $bhittaPath = storage_path('app/bhitta.json');

        // Check if file exists
        if (file_exists($bhittaPath)) {
            // Log::info('Inside initializeBhittaConfig if condition');
            $defaultConfig = [
                "limit" => 5,
                "slider_settings" => [
                    "autoplay" => true,
                    "speed" => 3000
                ],
                "testimonial_settings" => [
                    "show_on_homepage" => true
                ],
                "partner_settings" => [
                    "display_type" => "grid"
                ]
            ];
            // Log::info('Attempting to write to bhitta.json at: ' . $bhittaPath);
            // Save default settings
            file_put_contents($bhittaPath, json_encode($defaultConfig, JSON_PRETTY_PRINT));
            // Log::info('bhitta.json written successfully');
        }
    }
}










// FOR TESTIMONIAL 

if (!function_exists('getLatestTestimonials')) {
    function getLatestTestimonials()
    {
        $bhittaPath = storage_path('app/bhitta.json');
        //  = storage_path('app/bhitta.json');
        $filePath  = storage_path('app/public/cache/testimonial.json');
        if (!file_exists($filePath)) {
            return [];
        }

        // Get limit from JSON file (default to 5 if not set)
        if (file_exists($bhittaPath)) {
            $bhittaData = json_decode(file_get_contents($bhittaPath), true);
            $limit = $bhittaData['limit'] ?? 5;
        }
        // Read the SLIDER JSON file
        $jsonData = json_decode(file_get_contents($filePath), true);

        // Get only published testimonials
        if ($jsonData['testimonials']) {
            $testimonials = array_filter($jsonData['testimonials'], function ($testimonial) {
                // return $testimonial['published'] === "1";
                return $testimonial;
            });
        } else {
            $testimonials = [];
        }

        // Sort testimonials by latest (assuming latest is last in the array)
        $testimonials = array_reverse($testimonials);

        // Return only the limited number of testimonials
        return array_slice($testimonials, 0, $limit);
        // return array_slice($testimonials, 0);
    }
}

// STOR TESTIMONIAL
if (!function_exists('saveTestimonials')) {
    function saveTestimonials($newTestimonial)
    {
        $folderPath = storage_path('app/public/cache');
        $filePath = $folderPath . '/testimonial.json';
        $bhittaPath = storage_path('app/bhitta.json');

        if (!file_exists($folderPath)) {
            mkdir($folderPath, 0777, true);
        }
        
        if (file_exists($bhittaPath)) {
            $bhittaData = json_decode(file_get_contents($bhittaPath), true);
            $limit = $bhittaData['limit'] ?? 5;
        }
        // Read existing data or initialize JSON structure
        $jsonData = file_exists($filePath) ? json_decode(file_get_contents($filePath), true) : ['testimonials' => [], 'limit' => 5];

        // Add the new testimonial
        $newTestimonial['id'] = count($jsonData['testimonials']) + 1;
        $jsonData['testimonials'][] = $newTestimonial;

        if (count($jsonData['testimonials']) > $limit) {
            // Remove the oldest testimonial(s)
            $jsonData['testimonials'] = array_slice($jsonData['testimonials'], -$limit);
        }
        // Save updated data back to JSON file
        file_put_contents($filePath, json_encode($jsonData, JSON_PRETTY_PRINT));
    }
}

// EDIT TESTIMONIAL
// if (!function_exists('editTestimonial')) {
//     function editTestimonials($newTestimonial)
//     {
//         $filePath = storage_path('app/public/cache/testimonial.json');
//         $jsonData = file_exists($filePath) ? json_decode(file_get_contents($filePath), true) : ['testimonials' => [], 'limit' => 5];
//         // $found = false;
//         foreach ($jsonData['testimonials'] as &$testimonial) {
//             if ($testimonial['id'] == $newTestimonial['id']) {
//                 // $testimonial['published'] = $newTestimonialStatus['published'];
//                 return $testimonial;
//                 // $found=true;
//                 break;
//             }
//         }
//         // file_put_contents($filePath, json_encode($jsonData, JSON_PRETTY_PRINT));
//         return null;
//     }
// }

// UPDATE TESTIMONIAL
if (!function_exists('updateTestimonials')) {
    function updateTestimonials($newTestimonial)
    {
        // Log::info('Updating testimonial with ID: ' . $newTestimonial['id']);
        $filePath = storage_path('app/public/cache/testimonial.json');
        $jsonData = file_exists($filePath) ? json_decode(file_get_contents($filePath), true) : ['testimonials' => [], 'limit' => 5];

        $found = false; // Initialize found flag
        foreach ($jsonData['testimonials'] as &$testimonial) {
            if ($testimonial['db_id'] == $newTestimonial['db_id']) {
                if ($newTestimonial['image']) {
                    $testimonial = $newTestimonial;
                } else {
                    $testimonial['name'] = $newTestimonial['name'];
                    $testimonial['message'] = $newTestimonial['message'];
                    $testimonial['image'] = $testimonial['image'];
                    $testimonial['published'] = $newTestimonial['published'];
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


// UPDATE STATUS OF TESTIMONIAL FROM INDEX
if (!function_exists('updateTestimonialsStatus')) {
    function updateTestimonialsStatus($newTestimonialStatus)
    {
        $filePath = storage_path('app/public/cache/testimonial.json');
        $jsonData = file_exists($filePath) ? json_decode(file_get_contents($filePath), true) : ['testimonials' => [], 'limit' => 5];
        $found = false;
        foreach ($jsonData['testimonials'] as $key => &$testimonial) {
            if ($testimonial['db_id'] == $newTestimonialStatus['db_id'] && $newTestimonialStatus['published']==0) {
                  unset($jsonData['testimonials'][$key]);
                $found = true;
                break;
            }
        }
        file_put_contents($filePath, json_encode($jsonData, JSON_PRETTY_PRINT));
        return $found;
    }
}

// DELETE TESTIMONIAL
if (!function_exists('deleteTestimonials')) {
    function deleteTestimonials($newTestimonial)
    {
        $filePath = storage_path('app/public/cache/testimonial.json');
        $jsonData = file_exists($filePath) ? json_decode(file_get_contents($filePath), true) : ['testimonials' => [], 'limit' => 5];
        $found = false;
        foreach ($jsonData['testimonials'] as $key => &$testimonial) {
            if ($testimonial['db_id'] == $newTestimonial['db_id']) {
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
















// // PARTNERS

if (!function_exists('getLatestPartners')) {
    function getLatestPartners()
    {
        $bhittaPath = storage_path('app/bhitta.json');
        //  = storage_path('app/bhitta.json');
        $filePath  = storage_path('app/public/cache/partner.json');
        if (!file_exists($filePath)) {
            return [];
        }

        // Get limit from JSON file (default to 5 if not set)
        if (file_exists($bhittaPath)) {
            $bhittaData = json_decode(file_get_contents($bhittaPath), true);
            $limit = $bhittaData['limit'] ?? 5;
        }
        // Read the JSON file
        $jsonData = json_decode(file_get_contents($filePath), true);

        // Get limit from JSON file (default to 5 if not set)
        // $limit = $jsonData['limit'] ?? 5;

        // Get only published testimonials
        if (isset($jsonData['partners'])) {
            $partners = array_filter($jsonData['partners'], function ($partner) {
                // return $testimonial['published'] === "1";
                return $partner;
            });
        } else {
            $partners = [];
        }

        // Sort testimonials by latest (assuming latest is last in the array)
        $partners = array_reverse($partners);

        // Return only the limited number of testimonials
        // return array_slice($testimonials, 0, $limit);
        return array_slice($partners, 0);
    }
}


// PARTNER STORE
if (!function_exists('savePartners')) {
    function savePartners($newPartner)
    {
        $folderPath = storage_path('app/public/cache');
        $filePath = $folderPath . '/partner.json';

        if (!file_exists($folderPath)) {
            mkdir($folderPath, 0777, true);
        }
        $jsonData = file_exists($filePath) ? json_decode(file_get_contents($filePath), true) : ['partners' => [], 'limit' => 5];
        // Check if 'partners' key exists in the data, if not, initialize it
        if (!isset($jsonData['partners'])) {
            $jsonData['partners'] = [];
        }

        $newPartner['id'] = count($jsonData['partners']) + 1;
        $jsonData['partners'][] = $newPartner;

        // Save updated data back to JSON file
        file_put_contents($filePath, json_encode($jsonData, JSON_PRETTY_PRINT));
    }
}

// EDIT PARTNERS
if (!function_exists('editPartners')) {
    function editPartners($newPartner)
    {
        $filePath = storage_path('app/public/cache/partner.json');
        $jsonData = file_exists($filePath) ? json_decode(file_get_contents($filePath), true) : ['partners' => [], 'limit' => 5];

        foreach ($jsonData['partners'] as &$partner) {
            if ($partner['id'] == $newPartner['id']) {
                return $partner;
                break;
            }
        }
        return null;
    }
}

// UPDATE PARTNERS
if (!function_exists('updatePartners')) {
    function updatePartners($newPartner)
    {
        $filePath = storage_path('app/public/cache/partner.json');
        $jsonData = file_exists($filePath) ? json_decode(file_get_contents($filePath), true) : ['partners' => [], 'limit' => 5];

        foreach ($jsonData['partners'] as &$partner) {
            if ($partner['id'] == $newPartner['id']) {
                if ($newPartner['image']) {
                    $partner = $newPartner;
                } else {
                    $partner['name'] = $newPartner['name'];
                    $partner['url'] = $newPartner['url'];
                    $partner['image'] = $partner['image'];
                    $partner['published'] = $newPartner['published'];
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
        return $found ? true : 'Partner not found';
    }
}

// UPDATE STATUS OF PARTNERS FROM INDEX
if (!function_exists('updatePartnersStatus')) {
    function updatePartnersStatus($newPartner)
    {
        $filePath = storage_path('app/public/cache/partner.json');
        $jsonData = file_exists($filePath) ? json_decode(file_get_contents($filePath), true) : ['partners' => [], 'limit' => 5];
        $found = false;
        foreach ($jsonData['partners'] as &$partner) {
            if ($partner['id'] == $newPartner['id']) {
                $partner['published'] = $newPartner['published'];
                $found = true;
                break;
            }
        }
        file_put_contents($filePath, json_encode($jsonData, JSON_PRETTY_PRINT));
        return $found;
    }
}

// DELETE PARTNERS
if (!function_exists('deletePartners')) {
    function deletePartners($newPartner)
    {
        $filePath = storage_path('app/public/cache/partner.json');
        $jsonData = file_exists($filePath) ? json_decode(file_get_contents($filePath), true) : ['partners' => [], 'limit' => 5];
        $found = false;
        foreach ($jsonData['partners'] as $key => &$partner) {
            if ($partner['id'] == $newPartner['id']) {
                unset($jsonData['partners'][$key]);
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
        return $found ? true : 'Partner not found';
    }
}


















// SLIDERS
if (!function_exists('getLatestSliders')) {
    function getLatestSliders()
    {
        $bhittaPath = storage_path('app/bhitta.json');
        //  = storage_path('app/bhitta.json');
        $filePath  = storage_path('app/public/cache/slider.json');
        if (!file_exists($filePath)) {
            return [];
        }

        // Get limit from JSON file (default to 5 if not set)
        if (file_exists($bhittaPath)) {
            $bhittaData = json_decode(file_get_contents($bhittaPath), true);
            $limit = $bhittaData['limit'] ?? 5;
        }

        // Read the JSON file
        $jsonData = json_decode(file_get_contents($filePath), true);

        // Get limit from JSON file (default to 5 if not set)
        // $limit = $jsonData['limit'] ?? 5;

        // Get only published testimonials
        if (isset($jsonData['sliders'])) {
            $sliders = array_filter($jsonData['sliders'], function ($slider) {
                // return $testimonial['published'] === "1";
                return $slider;
            });
        } else {
            $sliders = [];
        }

        // Sort testimonials by latest (assuming latest is last in the array)
        $sliders = array_reverse($sliders);

        // Return only the limited number of testimonials
        // return array_slice($testimonials, 0, $limit);
        return array_slice($sliders, 0);
    }
}


if (!function_exists('saveSliders')) {
    function saveSliders($newSlider)
    {
        $folderPath = storage_path('app/public/cache');
        $filePath = $folderPath . '/slider.json';

        if (!file_exists($folderPath)) {
            mkdir($folderPath, 0777, true);
        }
        $jsonData = file_exists($filePath) ? json_decode(file_get_contents($filePath), true) : ['sliders' => [], 'limit' => 5];
        // Check if 'partners' key exists in the data, if not, initialize it
        if (!isset($jsonData['sliders'])) {
            $jsonData['sliders'] = [];
        }

        $newSlider['id'] = count($jsonData['sliders']) + 1;
        $jsonData['sliders'][] = $newSlider;

        // Save updated data back to JSON file
        file_put_contents($filePath, json_encode($jsonData, JSON_PRETTY_PRINT));
    }
}

if (!function_exists('updateSlidersStatus')) {
    function updateSlidersStatus($newSlider)
    {
        $filePath = storage_path('app/public/cache/slider.json');
        $jsonData = file_exists($filePath) ? json_decode(file_get_contents($filePath), true) : ['sliders' => [], 'limit' => 5];
        $found = false;
        foreach ($jsonData['sliders'] as &$slider) {
            if ($slider['id'] == $newSlider['id']) {
                $slider['published'] = $newSlider['published'];
                $found = true;
                break;
            }
        }
        file_put_contents($filePath, json_encode($jsonData, JSON_PRETTY_PRINT));
        return $found;
    }
}


if (!function_exists('editSliders')) {
    function editSliders($newSlider)
    {
        $filePath = storage_path('app/public/cache/slider.json');
        $jsonData = file_exists($filePath) ? json_decode(file_get_contents($filePath), true) : ['sliders' => [], 'limit' => 5];

        foreach ($jsonData['sliders'] as &$slider) {
            if ($slider['id'] == $newSlider['id']) {
                return $slider;
                break;
            }
        }
        return null;
    }
}


if (!function_exists('updateSliders')) {
    function updateSliders($newSlider)
    {
        $filePath = storage_path('app/public/cache/slider.json');
        $jsonData = file_exists($filePath) ? json_decode(file_get_contents($filePath), true) : ['sliders' => [], 'limit' => 5];

        foreach ($jsonData['sliders'] as &$slider) {
            if ($slider['id'] == $newSlider['id']) {
                if ($newSlider['image']) {
                    $slider = $newSlider;
                } else {
                    $slider['name'] = $newSlider['name'];
                    $slider['url'] = $newSlider['url'];
                    $slider['image'] = $slider['image'];
                    $slider['published'] = $newSlider['published'];
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
        return $found ? true : 'Slider not found';
    }
}

if (!function_exists('deleteSliders')) {
    function deleteSliders($newSlider)
    {
        $filePath = storage_path('app/public/cache/slider.json');
        $jsonData = file_exists($filePath) ? json_decode(file_get_contents($filePath), true) : ['sliders' => [], 'limit' => 5];
        $found = false;
        foreach ($jsonData['sliders'] as $key => &$slider) {
            if ($slider['id'] == $newSlider['id']) {
                unset($jsonData['sliders'][$key]);
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
        return $found ? true : 'Slider not found';
    }
}
