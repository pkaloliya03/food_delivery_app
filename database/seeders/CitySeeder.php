<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitySeeder extends Seeder
{
    public function run(): void
    {
        $cities = [
            // Gujarat
            ['name' => 'Ahmedabad', 'state' => 'Gujarat'],
            ['name' => 'Amreli', 'state' => 'Gujarat'],
            ['name' => 'Anand', 'state' => 'Gujarat'],
            ['name' => 'Bharuch', 'state' => 'Gujarat'],
            ['name' => 'Bhavnagar', 'state' => 'Gujarat'],
            ['name' => 'Bhuj', 'state' => 'Gujarat'],
            ['name' => 'Botad', 'state' => 'Gujarat'],
            ['name' => 'Dahod', 'state' => 'Gujarat'],
            ['name' => 'Deesa', 'state' => 'Gujarat'],
            ['name' => 'Gandhidham', 'state' => 'Gujarat'],
            ['name' => 'Gandhinagar', 'state' => 'Gujarat'],
            ['name' => 'Godhra', 'state' => 'Gujarat'],
            ['name' => 'Gondal', 'state' => 'Gujarat'],
            ['name' => 'Himmatnagar', 'state' => 'Gujarat'],
            ['name' => 'Jamnagar', 'state' => 'Gujarat'],
            ['name' => 'Junagadh', 'state' => 'Gujarat'],
            ['name' => 'Kalol', 'state' => 'Gujarat'],
            ['name' => 'Mahesana', 'state' => 'Gujarat'],
            ['name' => 'Morbi', 'state' => 'Gujarat'],
            ['name' => 'Nadiad', 'state' => 'Gujarat'],
            ['name' => 'Navsari', 'state' => 'Gujarat'],
            ['name' => 'Palanpur', 'state' => 'Gujarat'],
            ['name' => 'Patan', 'state' => 'Gujarat'],
            ['name' => 'Porbandar', 'state' => 'Gujarat'],
            ['name' => 'Rajkot', 'state' => 'Gujarat'],
            ['name' => 'Surat', 'state' => 'Gujarat'],
            ['name' => 'Surendranagar', 'state' => 'Gujarat'],
            ['name' => 'Vadodara', 'state' => 'Gujarat'],
            ['name' => 'Valsad', 'state' => 'Gujarat'],
            ['name' => 'Vapi', 'state' => 'Gujarat'],

            // Maharashtra
            ['name' => 'Mumbai', 'state' => 'Maharashtra'],
            ['name' => 'Pune', 'state' => 'Maharashtra'],
            ['name' => 'Nagpur', 'state' => 'Maharashtra'],
            ['name' => 'Nashik', 'state' => 'Maharashtra'],
            ['name' => 'Aurangabad', 'state' => 'Maharashtra'],
            ['name' => 'Thane', 'state' => 'Maharashtra'],
            ['name' => 'Navi Mumbai', 'state' => 'Maharashtra'],
            ['name' => 'Kolhapur', 'state' => 'Maharashtra'],
            ['name' => 'Solapur', 'state' => 'Maharashtra'],
            ['name' => 'Amravati', 'state' => 'Maharashtra'],
            ['name' => 'Satara', 'state' => 'Maharashtra'],
            ['name' => 'Sangli', 'state' => 'Maharashtra'],
            ['name' => 'Nanded', 'state' => 'Maharashtra'],
            ['name' => 'Jalgaon', 'state' => 'Maharashtra'],

            // Rajasthan
            ['name' => 'Jaipur', 'state' => 'Rajasthan'],
            ['name' => 'Jodhpur', 'state' => 'Rajasthan'],
            ['name' => 'Udaipur', 'state' => 'Rajasthan'],
            ['name' => 'Kota', 'state' => 'Rajasthan'],
            ['name' => 'Ajmer', 'state' => 'Rajasthan'],
            ['name' => 'Bikaner', 'state' => 'Rajasthan'],
            ['name' => 'Alwar', 'state' => 'Rajasthan'],
            ['name' => 'Bharatpur', 'state' => 'Rajasthan'],
            ['name' => 'Sikar', 'state' => 'Rajasthan'],

            // Delhi
            ['name' => 'New Delhi', 'state' => 'Delhi'],

            // Karnataka
            ['name' => 'Bengaluru', 'state' => 'Karnataka'],
            ['name' => 'Mysuru', 'state' => 'Karnataka'],
            ['name' => 'Mangaluru', 'state' => 'Karnataka'],
            ['name' => 'Hubballi', 'state' => 'Karnataka'],
            ['name' => 'Belagavi', 'state' => 'Karnataka'],
            ['name' => 'Dharwad', 'state' => 'Karnataka'],
            ['name' => 'Davangere', 'state' => 'Karnataka'],
            ['name' => 'Ballari', 'state' => 'Karnataka'],

            // Tamil Nadu
            ['name' => 'Chennai', 'state' => 'Tamil Nadu'],
            ['name' => 'Coimbatore', 'state' => 'Tamil Nadu'],
            ['name' => 'Madurai', 'state' => 'Tamil Nadu'],
            ['name' => 'Salem', 'state' => 'Tamil Nadu'],
            ['name' => 'Tiruchirappalli', 'state' => 'Tamil Nadu'],
            ['name' => 'Tiruppur', 'state' => 'Tamil Nadu'],
            ['name' => 'Tirunelveli', 'state' => 'Tamil Nadu'],
            ['name' => 'Erode', 'state' => 'Tamil Nadu'],
            ['name' => 'Vellore', 'state' => 'Tamil Nadu'],

            // Telangana
            ['name' => 'Hyderabad', 'state' => 'Telangana'],
            ['name' => 'Warangal', 'state' => 'Telangana'],
            ['name' => 'Nizamabad', 'state' => 'Telangana'],
            ['name' => 'Karimnagar', 'state' => 'Telangana'],

            // Andhra Pradesh
            ['name' => 'Visakhapatnam', 'state' => 'Andhra Pradesh'],
            ['name' => 'Vijayawada', 'state' => 'Andhra Pradesh'],
            ['name' => 'Guntur', 'state' => 'Andhra Pradesh'],
            ['name' => 'Tirupati', 'state' => 'Andhra Pradesh'],
            ['name' => 'Nellore', 'state' => 'Andhra Pradesh'],
            ['name' => 'Kurnool', 'state' => 'Andhra Pradesh'],

            // West Bengal
            ['name' => 'Kolkata', 'state' => 'West Bengal'],
            ['name' => 'Howrah', 'state' => 'West Bengal'],
            ['name' => 'Durgapur', 'state' => 'West Bengal'],
            ['name' => 'Siliguri', 'state' => 'West Bengal'],
            ['name' => 'Asansol', 'state' => 'West Bengal'],

            // Uttar Pradesh
            ['name' => 'Lucknow', 'state' => 'Uttar Pradesh'],
            ['name' => 'Kanpur', 'state' => 'Uttar Pradesh'],
            ['name' => 'Agra', 'state' => 'Uttar Pradesh'],
            ['name' => 'Varanasi', 'state' => 'Uttar Pradesh'],
            ['name' => 'Prayagraj', 'state' => 'Uttar Pradesh'],
            ['name' => 'Ghaziabad', 'state' => 'Uttar Pradesh'],
            ['name' => 'Noida', 'state' => 'Uttar Pradesh'],
            ['name' => 'Meerut', 'state' => 'Uttar Pradesh'],
            ['name' => 'Bareilly', 'state' => 'Uttar Pradesh'],
            ['name' => 'Gorakhpur', 'state' => 'Uttar Pradesh'],

            // Madhya Pradesh
            ['name' => 'Indore', 'state' => 'Madhya Pradesh'],
            ['name' => 'Bhopal', 'state' => 'Madhya Pradesh'],
            ['name' => 'Jabalpur', 'state' => 'Madhya Pradesh'],
            ['name' => 'Gwalior', 'state' => 'Madhya Pradesh'],
            ['name' => 'Ujjain', 'state' => 'Madhya Pradesh'],
            ['name' => 'Sagar', 'state' => 'Madhya Pradesh'],

            // Bihar
            ['name' => 'Patna', 'state' => 'Bihar'],
            ['name' => 'Gaya', 'state' => 'Bihar'],
            ['name' => 'Bhagalpur', 'state' => 'Bihar'],
            ['name' => 'Muzaffarpur', 'state' => 'Bihar'],

            // Punjab
            ['name' => 'Ludhiana', 'state' => 'Punjab'],
            ['name' => 'Amritsar', 'state' => 'Punjab'],
            ['name' => 'Jalandhar', 'state' => 'Punjab'],
            ['name' => 'Patiala', 'state' => 'Punjab'],
            ['name' => 'Bathinda', 'state' => 'Punjab'],

            // Haryana
            ['name' => 'Gurugram', 'state' => 'Haryana'],
            ['name' => 'Faridabad', 'state' => 'Haryana'],
            ['name' => 'Panipat', 'state' => 'Haryana'],
            ['name' => 'Ambala', 'state' => 'Haryana'],
            ['name' => 'Hisar', 'state' => 'Haryana'],

            // Odisha
            ['name' => 'Bhubaneswar', 'state' => 'Odisha'],
            ['name' => 'Cuttack', 'state' => 'Odisha'],
            ['name' => 'Rourkela', 'state' => 'Odisha'],
            ['name' => 'Puri', 'state' => 'Odisha'],

            // Kerala
            ['name' => 'Kochi', 'state' => 'Kerala'],
            ['name' => 'Thiruvananthapuram', 'state' => 'Kerala'],
            ['name' => 'Kozhikode', 'state' => 'Kerala'],
            ['name' => 'Thrissur', 'state' => 'Kerala'],
            ['name' => 'Kollam', 'state' => 'Kerala'],

            // Jharkhand
            ['name' => 'Ranchi', 'state' => 'Jharkhand'],
            ['name' => 'Jamshedpur', 'state' => 'Jharkhand'],
            ['name' => 'Dhanbad', 'state' => 'Jharkhand'],
            ['name' => 'Bokaro', 'state' => 'Jharkhand'],

            // Chhattisgarh
            ['name' => 'Raipur', 'state' => 'Chhattisgarh'],
            ['name' => 'Bhilai', 'state' => 'Chhattisgarh'],
            ['name' => 'Bilaspur', 'state' => 'Chhattisgarh'],
            ['name' => 'Korba', 'state' => 'Chhattisgarh'],

            // Assam
            ['name' => 'Guwahati', 'state' => 'Assam'],
            ['name' => 'Dibrugarh', 'state' => 'Assam'],
            ['name' => 'Silchar', 'state' => 'Assam'],

            // Uttarakhand
            ['name' => 'Dehradun', 'state' => 'Uttarakhand'],
            ['name' => 'Haridwar', 'state' => 'Uttarakhand'],
            ['name' => 'Nainital', 'state' => 'Uttarakhand'],
            ['name' => 'Haldwani', 'state' => 'Uttarakhand'],

            // Himachal Pradesh
            ['name' => 'Shimla', 'state' => 'Himachal Pradesh'],
            ['name' => 'Dharamshala', 'state' => 'Himachal Pradesh'],
            ['name' => 'Manali', 'state' => 'Himachal Pradesh'],
            ['name' => 'Solan', 'state' => 'Himachal Pradesh'],

            // Goa
            ['name' => 'Panaji', 'state' => 'Goa'],
            ['name' => 'Vasco da Gama', 'state' => 'Goa'],
            ['name' => 'Margao', 'state' => 'Goa'],

            // Jammu & Kashmir
            ['name' => 'Srinagar', 'state' => 'Jammu and Kashmir'],
            ['name' => 'Jammu', 'state' => 'Jammu and Kashmir'],

            // Chandigarh
            ['name' => 'Chandigarh', 'state' => 'Chandigarh'],

            // Puducherry
            ['name' => 'Puducherry', 'state' => 'Puducherry'],

            // Sikkim
            ['name' => 'Gangtok', 'state' => 'Sikkim'],

            // Meghalaya
            ['name' => 'Shillong', 'state' => 'Meghalaya'],

            // Manipur
            ['name' => 'Imphal', 'state' => 'Manipur'],

            // Mizoram
            ['name' => 'Aizawl', 'state' => 'Mizoram'],

            // Nagaland
            ['name' => 'Kohima', 'state' => 'Nagaland'],
            ['name' => 'Dimapur', 'state' => 'Nagaland'],

            // Tripura
            ['name' => 'Agartala', 'state' => 'Tripura'],

            // Arunachal Pradesh
            ['name' => 'Itanagar', 'state' => 'Arunachal Pradesh'],

            // Andaman and Nicobar Islands
            ['name' => 'Port Blair', 'state' => 'Andaman and Nicobar Islands'],
        ];

        foreach ($cities as $city) {
            DB::table('master_cities')->updateOrInsert(
                [
                    'name' => $city['name'],
                    'state' => $city['state'],
                ],
                [
                    'status' => true,
                    'updated_at' => now(),
                    'created_at' => now(),
                ]
            );
        }
    }
}
