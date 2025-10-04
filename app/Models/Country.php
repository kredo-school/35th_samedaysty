<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Country extends Model
{
    protected $fillable = [
        'name',
        'code',
    ];

    /**
     * Get travel plans for this country
     * Note: TravelPlan model not yet implemented
     */
    // country has many plans
    public function travelPlans()
    {
        return $this->hasMany(TravelPlan::class);
    }


    /**
     * Get display name for the country
     */
    public function getDisplayNameAttribute(): string
    {
        return $this->name;
    }

    /**
     * Get the region for this country
     */
    public function getRegionAttribute(): string
    {
        $regionMap = [
            'Asia' => ['Japan', 'South Korea', 'China', 'Taiwan', 'Hong Kong', 'Singapore', 'Thailand', 'Vietnam', 'Cambodia', 'Laos', 'Myanmar', 'Malaysia', 'Indonesia', 'Philippines', 'Brunei', 'India', 'Pakistan', 'Bangladesh', 'Sri Lanka', 'Nepal', 'Bhutan', 'Maldives'],
            'Europe' => ['United Kingdom', 'France', 'Germany', 'Italy', 'Spain', 'Netherlands', 'Belgium', 'Switzerland', 'Austria', 'Sweden', 'Norway', 'Denmark', 'Finland', 'Iceland', 'Ireland', 'Portugal', 'Greece', 'Poland', 'Czech Republic', 'Hungary', 'Croatia', 'Slovenia', 'Slovakia', 'Estonia', 'Latvia', 'Lithuania', 'Romania', 'Bulgaria', 'Serbia', 'Montenegro', 'Bosnia and Herzegovina', 'North Macedonia', 'Albania', 'Moldova', 'Ukraine', 'Belarus', 'Russia'],
            'North America' => ['United States', 'Canada', 'Mexico'],
            'South America' => ['Brazil', 'Argentina', 'Chile', 'Peru', 'Colombia', 'Venezuela', 'Ecuador', 'Bolivia', 'Paraguay', 'Uruguay', 'Guyana', 'Suriname'],
            'Africa' => ['South Africa', 'Egypt', 'Morocco', 'Tunisia', 'Kenya', 'Tanzania', 'Uganda', 'Rwanda', 'Ethiopia', 'Ghana', 'Nigeria', 'Senegal', 'Mali', 'Burkina Faso', 'Niger', 'Chad', 'Sudan', 'Libya', 'Algeria', 'Mauritania', 'Gambia', 'Guinea-Bissau', 'Guinea', 'Sierra Leone', 'Liberia', 'Ivory Coast', 'Togo', 'Benin', 'Cameroon', 'Central African Republic', 'Equatorial Guinea', 'Gabon', 'Republic of the Congo', 'Democratic Republic of the Congo', 'Angola', 'Zambia', 'Malawi', 'Mozambique', 'Zimbabwe', 'Botswana', 'Namibia', 'Lesotho', 'Eswatini', 'Madagascar', 'Mauritius', 'Seychelles', 'Comoros', 'Djibouti', 'Eritrea', 'Somalia', 'South Sudan'],
            'Oceania' => ['Australia', 'New Zealand', 'Fiji', 'Papua New Guinea', 'Solomon Islands', 'Vanuatu', 'Samoa', 'Tonga', 'Kiribati', 'Tuvalu', 'Nauru', 'Palau', 'Marshall Islands', 'Micronesia'],
            'Caribbean' => ['Jamaica', 'Cuba', 'Dominican Republic', 'Haiti', 'Puerto Rico', 'Trinidad and Tobago', 'Barbados', 'Bahamas', 'Belize', 'Costa Rica', 'Panama', 'Guatemala', 'Honduras', 'El Salvador', 'Nicaragua', 'Antigua and Barbuda', 'Saint Kitts and Nevis', 'Dominica', 'Saint Lucia', 'Saint Vincent and the Grenadines', 'Grenada']
        ];

        foreach ($regionMap as $region => $countries) {
            if (in_array($this->name, $countries)) {
                return $region;
            }
        }

        return 'Other';
    }

    /**
     * Get countries grouped by region
     */
    public static function getGroupedByRegion()
    {
        return self::all()->groupBy('region');
    }

    /**
     * Get coordinates for the country
     */
    public function getCoordinatesAttribute(): array
    {
        $coordinates = [
            'Japan' => [36.2048, 138.2529],
            'South Korea' => [35.9078, 127.7669],
            'China' => [35.8617, 104.1954],
            'Taiwan' => [23.6978, 120.9605],
            'Hong Kong' => [22.3193, 114.1694],
            'Singapore' => [1.3521, 103.8198],
            'Thailand' => [15.8700, 100.9925],
            'Vietnam' => [14.0583, 108.2772],
            'United States' => [39.8283, -98.5795],
            'Canada' => [56.1304, -106.3468],
            'Mexico' => [23.6345, -102.5528],
            'United Kingdom' => [55.3781, -3.4360],
            'France' => [46.2276, 2.2137],
            'Germany' => [51.1657, 10.4515],
            'Italy' => [41.8719, 12.5674],
            'Spain' => [40.4637, -3.7492],
            'Australia' => [-25.2744, 133.7751],
            'New Zealand' => [-40.9006, 174.8860],
            'Brazil' => [-14.2350, -51.9253],
            'Argentina' => [-38.4161, -63.6167],
            'Chile' => [-35.6751, -71.5430],
            'India' => [20.5937, 78.9629],
            'Indonesia' => [-0.7893, 113.9213],
            'Philippines' => [12.8797, 121.7740],
            'Malaysia' => [4.2105, 101.9758],
            'Cambodia' => [12.5657, 104.9910],
            'Laos' => [19.8563, 102.4955],
            'Myanmar' => [21.9162, 95.9560],
            'Brunei' => [4.5353, 114.7277],
            'Pakistan' => [30.3753, 69.3451],
            'Bangladesh' => [23.6850, 90.3563],
            'Sri Lanka' => [7.8731, 80.7718],
            'Nepal' => [28.3949, 84.1240],
            'Bhutan' => [27.5142, 90.4336],
            'Maldives' => [3.2028, 73.2207],
            'Netherlands' => [52.1326, 5.2913],
            'Belgium' => [50.5039, 4.4699],
            'Switzerland' => [46.8182, 8.2275],
            'Austria' => [47.5162, 14.5501],
            'Sweden' => [60.1282, 18.6435],
            'Norway' => [60.4720, 8.4689],
            'Denmark' => [56.2639, 9.5018],
            'Finland' => [61.9241, 25.7482],
            'Iceland' => [64.9631, -19.0208],
            'Ireland' => [53.4129, -8.2439],
            'Portugal' => [39.3999, -8.2245],
            'Greece' => [39.0742, 21.8243],
            'Poland' => [51.9194, 19.1451],
            'Czech Republic' => [49.8175, 15.4730],
            'Hungary' => [47.1625, 19.5033],
            'Croatia' => [45.1000, 15.2000],
            'Slovenia' => [46.1512, 14.9955],
            'Slovakia' => [48.6690, 19.6990],
            'Estonia' => [58.5953, 25.0136],
            'Latvia' => [56.8796, 24.6032],
            'Lithuania' => [55.1694, 23.8813],
            'Romania' => [45.9432, 24.9668],
            'Bulgaria' => [42.7339, 25.4858],
            'Serbia' => [44.0165, 21.0059],
            'Montenegro' => [42.7087, 19.3744],
            'Bosnia and Herzegovina' => [43.9159, 17.6791],
            'North Macedonia' => [41.6086, 21.7453],
            'Albania' => [41.1533, 20.1683],
            'Moldova' => [47.4116, 28.3699],
            'Ukraine' => [48.3794, 31.1656],
            'Belarus' => [53.7098, 27.9534],
            'Russia' => [61.5240, 105.3188],
            'South Africa' => [-30.5595, 22.9375],
            'Egypt' => [26.0975, 30.0444],
            'Morocco' => [31.7917, -7.0926],
            'Tunisia' => [33.8869, 9.5375],
            'Kenya' => [-0.0236, 37.9062],
            'Tanzania' => [-6.3690, 34.8888],
            'Uganda' => [1.3733, 32.2903],
            'Rwanda' => [-1.9403, 29.8739],
            'Ethiopia' => [9.1450, 40.4897],
            'Ghana' => [7.9465, -1.0232],
            'Nigeria' => [9.081999, 8.675277],
            'Senegal' => [14.4974, -14.4524],
            'Mali' => [17.5707, -3.9962],
            'Burkina Faso' => [12.2383, -1.5616],
            'Niger' => [17.6078, 8.0817],
            'Chad' => [15.4542, 18.7322],
            'Sudan' => [12.8628, 30.2176],
            'Libya' => [26.3351, 17.2283],
            'Algeria' => [28.0339, 1.6596],
            'Mauritania' => [21.0079, -10.9408],
            'Gambia' => [13.4432, -15.3101],
            'Guinea-Bissau' => [11.8037, -15.1804],
            'Guinea' => [9.6412, -9.6966],
            'Sierra Leone' => [8.4606, -11.7799],
            'Liberia' => [6.4281, -9.4295],
            'Ivory Coast' => [7.5400, -5.5471],
            'Togo' => [8.6195, 0.8248],
            'Benin' => [9.3077, 2.3158],
            'Cameroon' => [7.3697, 12.3547],
            'Central African Republic' => [6.6111, 20.9394],
            'Equatorial Guinea' => [1.6508, 10.2679],
            'Gabon' => [-0.8037, 11.6094],
            'Republic of the Congo' => [-0.2280, 15.8277],
            'Democratic Republic of the Congo' => [-4.0383, 21.7587],
            'Angola' => [-11.2027, 17.8739],
            'Zambia' => [-13.1339, 27.8493],
            'Malawi' => [-13.2543, 34.3015],
            'Mozambique' => [-18.6657, 35.5296],
            'Zimbabwe' => [-19.0154, 29.1549],
            'Botswana' => [-22.3285, 24.6849],
            'Namibia' => [-22.9576, 18.4904],
            'Lesotho' => [-29.6100, 28.2336],
            'Eswatini' => [-26.5225, 31.4659],
            'Madagascar' => [-18.7669, 46.8691],
            'Mauritius' => [-20.3484, 57.5522],
            'Seychelles' => [-4.6796, 55.4920],
            'Comoros' => [-11.6455, 43.3333],
            'Djibouti' => [11.8251, 42.5903],
            'Eritrea' => [15.1794, 39.7823],
            'Somalia' => [5.1521, 46.1996],
            'South Sudan' => [6.8770, 31.3070],
            'Fiji' => [-16.5788, 179.4144],
            'Papua New Guinea' => [-6.3149, 143.9555],
            'Solomon Islands' => [-9.6457, 160.1562],
            'Vanuatu' => [-15.3767, 166.9592],
            'Samoa' => [-13.7590, -172.1046],
            'Tonga' => [-21.1789, -175.1982],
            'Kiribati' => [-3.3704, -168.7340],
            'Tuvalu' => [-7.1095, 177.6493],
            'Nauru' => [-0.5228, 166.9315],
            'Palau' => [7.5150, 134.5825],
            'Marshall Islands' => [7.1315, 171.1845],
            'Micronesia' => [7.4256, 150.5508],
            'Jamaica' => [18.1096, -77.2975],
            'Cuba' => [21.5218, -77.7812],
            'Dominican Republic' => [18.7357, -70.1627],
            'Haiti' => [18.9712, -72.2852],
            'Puerto Rico' => [18.2208, -66.5901],
            'Trinidad and Tobago' => [10.6918, -61.2225],
            'Barbados' => [13.1939, -59.5432],
            'Bahamas' => [25.0343, -77.3963],
            'Belize' => [17.1899, -88.4976],
            'Costa Rica' => [9.7489, -83.7534],
            'Panama' => [8.5380, -80.7821],
            'Guatemala' => [15.7835, -90.2308],
            'Honduras' => [15.2000, -86.2419],
            'El Salvador' => [13.7942, -88.8965],
            'Nicaragua' => [12.2650, -85.2072],
            'Antigua and Barbuda' => [17.0608, -61.7964],
            'Saint Kitts and Nevis' => [17.3578, -62.7830],
            'Dominica' => [15.4150, -61.3710],
            'Saint Lucia' => [13.9094, -60.9789],
            'Saint Vincent and the Grenadines' => [12.9843, -61.2872],
            'Grenada' => [12.2626, -61.6046],
        ];

        return $coordinates[$this->name] ?? [0, 0]; // Default to [0, 0] if country not found
    }


}
