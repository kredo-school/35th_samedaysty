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


}
