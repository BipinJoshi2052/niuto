<?php

namespace Database\Seeders;

use App\Models\Admin\State;
use Illuminate\Database\Seeder;

class StatesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {

        State::where('id', '>', '0')->delete();

        State::insertOrIgnore([
            [
                'id' => 1,
                'country_id' => 223,
                'name' => 'Alabama',
            ],
            [
                'id' => 2,
                'country_id' => 223,
                'name' => 'Alaska',
            ],
            [
                'id' => 3,
                'country_id' => 223,
                'name' => 'American Samoa',
            ],
            [
                'id' => 4,
                'country_id' => 223,
                'name' => 'Arizona',
            ],
            [
                'id' => 5,
                'country_id' => 223,
                'name' => 'Arkansas',
            ],
            [
                'id' => 6,
                'country_id' => 223,
                'name' => 'Armed Forces Africa',
            ],
            [
                'id' => 7,
                'country_id' => 223,
                'name' => 'Armed Forces Americas',
            ],
            [
                'id' => 8,
                'country_id' => 223,
                'name' => 'Armed Forces Canada',
            ],
            [
                'id' => 9,
                'country_id' => 223,
                'name' => 'Armed Forces Europe',
            ],
            [
                'id' => 10,
                'country_id' => 223,
                'name' => 'Armed Forces Middle East',
            ],
            [
                'id' => 11,
                'country_id' => 223,
                'name' => 'Armed Forces Pacific',
            ],
            [
                'id' => 12,
                'country_id' => 223,
                'name' => 'California',
            ],
            [
                'id' => 13,
                'country_id' => 223,
                'name' => 'Colorado',
            ],
            [
                'id' => 14,
                'country_id' => 223,
                'name' => 'Connecticut',
            ],
            [
                'id' => 15,
                'country_id' => 223,
                'name' => 'Delaware',
            ],
            [
                'id' => 16,
                'country_id' => 223,
                'name' => 'District of Columbia',
            ],
            [
                'id' => 17,
                'country_id' => 223,
                'name' => 'Federated States Of Micronesia',
            ],
            [
                'id' => 18,
                'country_id' => 223,
                'name' => 'Florida',
            ],
            [
                'id' => 19,
                'country_id' => 223,
                'name' => 'Georgia',
            ],
            [
                'id' => 20,
                'country_id' => 223,
                'name' => 'Guam',
            ],
            [
                'id' => 21,
                'country_id' => 223,
                'name' => 'Hawaii',
            ],
            [
                'id' => 22,
                'country_id' => 223,
                'name' => 'Idaho',
            ],
            [
                'id' => 23,
                'country_id' => 223,
                'name' => 'Illinois',
            ],
            [
                'id' => 24,
                'country_id' => 223,
                'name' => 'Indiana',
            ],
            [
                'id' => 25,
                'country_id' => 223,
                'name' => 'Iowa',
            ],
            [
                'id' => 26,
                'country_id' => 223,
                'name' => 'Kansas',
            ],
            [
                'id' => 27,
                'country_id' => 223,
                'name' => 'Kentucky',
            ],
            [
                'id' => 28,
                'country_id' => 223,
                'name' => 'Louisiana',
            ],
            [
                'id' => 29,
                'country_id' => 223,
                'name' => 'Maine',
            ],
            [
                'id' => 30,
                'country_id' => 223,
                'name' => 'Marshall Islands',
            ],
            [
                'id' => 31,
                'country_id' => 223,
                'name' => 'Maryland',
            ],
            [
                'id' => 32,
                'country_id' => 223,
                'name' => 'Massachusetts',
            ],
            [
                'id' => 33,
                'country_id' => 223,
                'name' => 'Michigan',
            ],
            [
                'id' => 34,
                'country_id' => 223,
                'name' => 'Minnesota',
            ],
            [
                'id' => 35,
                'country_id' => 223,
                'name' => 'Mississippi',
            ],
            [
                'id' => 36,
                'country_id' => 223,
                'name' => 'Missouri',
            ],
            [
                'id' => 37,
                'country_id' => 223,
                'name' => 'Montana',
            ],
            [
                'id' => 38,
                'country_id' => 223,
                'name' => 'Nebraska',
            ],
            [
                'id' => 39,
                'country_id' => 223,
                'name' => 'Nevada',
            ],
            [
                'id' => 40,
                'country_id' => 223,
                'name' => 'New Hampshire',
            ],
            [
                'id' => 41,
                'country_id' => 223,
                'name' => 'New Jersey',
            ],
            [
                'id' => 42,
                'country_id' => 223,
                'name' => 'New Mexico',
            ],
            [
                'id' => 43,
                'country_id' => 223,
                'name' => 'New York',
            ],
            [
                'id' => 44,
                'country_id' => 223,
                'name' => 'North Carolina',
            ],
            [
                'id' => 45,
                'country_id' => 223,
                'name' => 'North Dakota',
            ],
            [
                'id' => 46,
                'country_id' => 223,
                'name' => 'Northern Mariana Islands',
            ],
            [
                'id' => 47,
                'country_id' => 223,
                'name' => 'Ohio',
            ],
            [
                'id' => 48,
                'country_id' => 223,
                'name' => 'Oklahoma',
            ],
            [
                'id' => 49,
                'country_id' => 223,
                'name' => 'Oregon',
            ],
            [
                'id' => 50,
                'country_id' => 223,
                'name' => 'Palau',
            ],
            [
                'id' => 51,
                'country_id' => 223,
                'name' => 'Pennsylvania',
            ],
            [
                'id' => 52,
                'country_id' => 223,
                'name' => 'Puerto Rico',
            ],
            [
                'id' => 53,
                'country_id' => 223,
                'name' => 'Rhode Island',
            ],
            [
                'id' => 54,
                'country_id' => 223,
                'name' => 'South Carolina',
            ],
            [
                'id' => 55,
                'country_id' => 223,
                'name' => 'South Dakota',
            ],
            [
                'id' => 56,
                'country_id' => 223,
                'name' => 'Tennessee',
            ],
            [
                'id' => 57,
                'country_id' => 223,
                'name' => 'Texas',
            ],
            [
                'id' => 58,
                'country_id' => 223,
                'name' => 'Utah',
            ],
            [
                'id' => 59,
                'country_id' => 223,
                'name' => 'Vermont',
            ],
            [
                'id' => 60,
                'country_id' => 223,
                'name' => 'Virgin Islands',
            ],
            [
                'id' => 61,
                'country_id' => 223,
                'name' => 'Virginia',
            ],
            [
                'id' => 62,
                'country_id' => 223,
                'name' => 'Washington',
            ],
            [
                'id' => 63,
                'country_id' => 223,
                'name' => 'West Virginia',
            ],
            [
                'id' => 64,
                'country_id' => 223,
                'name' => 'Wisconsin',
            ],
            [
                'id' => 65,
                'country_id' => 223,
                'name' => 'Wyoming',
            ],
            [
                'id' => 66,
                'country_id' => 38,
                'name' => 'Alberta',
            ],
            [
                'id' => 67,
                'country_id' => 38,
                'name' => 'British Columbia',
            ],
            [
                'id' => 68,
                'country_id' => 38,
                'name' => 'Manitoba',
            ],
            [
                'id' => 69,
                'country_id' => 38,
                'name' => 'Newfoundland',
            ],
            [
                'id' => 70,
                'country_id' => 38,
                'name' => 'New Brunswick',
            ],
            [
                'id' => 71,
                'country_id' => 38,
                'name' => 'Nova Scotia',
            ],
            [
                'id' => 72,
                'country_id' => 38,
                'name' => 'Northwest Territories',
            ],
            [
                'id' => 73,
                'country_id' => 38,
                'name' => 'Nunavut',
            ],
            [
                'id' => 74,
                'country_id' => 38,
                'name' => 'Ontario',
            ],
            [
                'id' => 75,
                'country_id' => 38,
                'name' => 'Prince Edward Island',
            ],
            [
                'id' => 76,
                'country_id' => 38,
                'name' => 'Quebec',
            ],
            [
                'id' => 77,
                'country_id' => 38,
                'name' => 'Saskatchewan',
            ],
            [
                'id' => 78,
                'country_id' => 38,
                'name' => 'Yukon Territory',
            ],
            [
                'id' => 79,
                'country_id' => 81,
                'name' => 'Niedersachsen',
            ],
            [
                'id' => 80,
                'country_id' => 81,
                'name' => 'Baden-Württemberg',
            ],
            [
                'id' => 81,
                'country_id' => 81,
                'name' => 'Bayern',
            ],
            [
                'id' => 82,
                'country_id' => 81,
                'name' => 'Berlin',
            ],
            [
                'id' => 83,
                'country_id' => 81,
                'name' => 'Brandenburg',
            ],
            [
                'id' => 84,
                'country_id' => 81,
                'name' => 'Bremen',
            ],
            [
                'id' => 85,
                'country_id' => 81,
                'name' => 'Hamburg',
            ],
            [
                'id' => 86,
                'country_id' => 81,
                'name' => 'Hessen',
            ],
            [
                'id' => 87,
                'country_id' => 81,
                'name' => 'Mecklenburg-Vorpommern',
            ],
            [
                'id' => 88,
                'country_id' => 81,
                'name' => 'Nordrhein-Westfalen',
            ],
            [
                'id' => 89,
                'country_id' => 81,
                'name' => 'Rheinland-Pfalz',
            ],
            [
                'id' => 90,
                'country_id' => 81,
                'name' => 'Saarland',
            ],
            [
                'id' => 91,
                'country_id' => 81,
                'name' => 'Sachsen',
            ],
            [
                'id' => 92,
                'country_id' => 81,
                'name' => 'Sachsen-Anhalt',
            ],
            [
                'id' => 93,
                'country_id' => 81,
                'name' => 'Schleswig-Holstein',
            ],
            [
                'id' => 94,
                'country_id' => 81,
                'name' => 'Thüringen',
            ],
            [
                'id' => 95,
                'country_id' => 14,
                'name' => 'Wien',
            ],
            [
                'id' => 96,
                'country_id' => 14,
                'name' => 'Niederösterreich',
            ],
            [
                'id' => 97,
                'country_id' => 14,
                'name' => 'Oberösterreich',
            ],
            [
                'id' => 98,
                'country_id' => 14,
                'name' => 'Salzburg',
            ],
            [
                'id' => 99,
                'country_id' => 14,
                'name' => 'Kärnten',
            ],
            [
                'id' => 100,
                'country_id' => 14,
                'name' => 'Steiermark',
            ],
            [
                'id' => 101,
                'country_id' => 14,
                'name' => 'Tirol',
            ],
            [
                'id' => 102,
                'country_id' => 14,
                'name' => 'Burgenland',
            ],
            [
                'id' => 103,
                'country_id' => 14,
                'name' => 'Voralberg',
            ],
            [
                'id' => 104,
                'country_id' => 204,
                'name' => 'Aargau',
            ],
            [
                'id' => 105,
                'country_id' => 204,
                'name' => 'Appenzell Innerrhoden',
            ],
            [
                'id' => 106,
                'country_id' => 204,
                'name' => 'Appenzell Ausserrhoden',
            ],
            [
                'id' => 107,
                'country_id' => 204,
                'name' => 'Bern',
            ],
            [
                'id' => 108,
                'country_id' => 204,
                'name' => 'Basel-Landschaft',
            ],
            [
                'id' => 109,
                'country_id' => 204,
                'name' => 'Basel-Stadt',
            ],
            [
                'id' => 110,
                'country_id' => 204,
                'name' => 'Freiburg',
            ],
            [
                'id' => 111,
                'country_id' => 204,
                'name' => 'Genf',
            ],
            [
                'id' => 112,
                'country_id' => 204,
                'name' => 'Glarus',
            ],
            [
                'id' => 113,
                'country_id' => 204,
                'name' => 'Graubünden',
            ],
            [
                'id' => 114,
                'country_id' => 204,
                'name' => 'Jura',
            ],
            [
                'id' => 115,
                'country_id' => 204,
                'name' => 'Luzern',
            ],
            [
                'id' => 116,
                'country_id' => 204,
                'name' => 'Neuenburg',
            ],
            [
                'id' => 117,
                'country_id' => 204,
                'name' => 'Nidwalden',
            ],
            [
                'id' => 118,
                'country_id' => 204,
                'name' => 'Obwalden',
            ],
            [
                'id' => 119,
                'country_id' => 204,
                'name' => 'St. Gallen',
            ],
            [
                'id' => 120,
                'country_id' => 204,
                'name' => 'Schaffhausen',
            ],
        ]);
        State::insertOrIgnore([
            [
                'id' => 121,
                'country_id' => 204,
                'name' => 'Solothurn',
            ],
            [
                'id' => 122,
                'country_id' => 204,
                'name' => 'Schwyz',
            ],
            [
                'id' => 123,
                'country_id' => 204,
                'name' => 'Thurgau',
            ],
            [
                'id' => 124,
                'country_id' => 204,
                'name' => 'Tessin',
            ],
            [
                'id' => 125,
                'country_id' => 204,
                'name' => 'Uri',
            ],
            [
                'id' => 126,
                'country_id' => 204,
                'name' => 'Waadt',
            ],
            [
                'id' => 127,
                'country_id' => 204,
                'name' => 'Wallis',
            ],
            [
                'id' => 128,
                'country_id' => 204,
                'name' => 'Zug',
            ],
            [
                'id' => 129,
                'country_id' => 204,
                'name' => 'Zürich',
            ],
            [
                'id' => 130,
                'country_id' => 195,
                'name' => 'A Coruña',
            ],
            [
                'id' => 131,
                'country_id' => 195,
                'name' => 'Alava',
            ],
            [
                'id' => 132,
                'country_id' => 195,
                'name' => 'Albacete',
            ],
            [
                'id' => 133,
                'country_id' => 195,
                'name' => 'Alicante',
            ],
            [
                'id' => 134,
                'country_id' => 195,
                'name' => 'Almeria',
            ],
            [
                'id' => 135,
                'country_id' => 195,
                'name' => 'Asturias',
            ],
            [
                'id' => 136,
                'country_id' => 195,
                'name' => 'Avila',
            ],
            [
                'id' => 137,
                'country_id' => 195,
                'name' => 'Badajoz',
            ],
            [
                'id' => 138,
                'country_id' => 195,
                'name' => 'Baleares',
            ],
            [
                'id' => 139,
                'country_id' => 195,
                'name' => 'Barcelona',
            ],
            [
                'id' => 140,
                'country_id' => 195,
                'name' => 'Burgos',
            ],
            [
                'id' => 141,
                'country_id' => 195,
                'name' => 'Caceres',
            ],
            [
                'id' => 142,
                'country_id' => 195,
                'name' => 'Cadiz',
            ],
            [
                'id' => 143,
                'country_id' => 195,
                'name' => 'Cantabria',
            ],
            [
                'id' => 144,
                'country_id' => 195,
                'name' => 'Castellon',
            ],
            [
                'id' => 145,
                'country_id' => 195,
                'name' => 'Ceuta',
            ],
            [
                'id' => 146,
                'country_id' => 195,
                'name' => 'Ciudad Real',
            ],
            [
                'id' => 147,
                'country_id' => 195,
                'name' => 'Cordoba',
            ],
            [
                'id' => 148,
                'country_id' => 195,
                'name' => 'Cuenca',
            ],
            [
                'id' => 149,
                'country_id' => 195,
                'name' => 'Girona',
            ],
            [
                'id' => 150,
                'country_id' => 195,
                'name' => 'Granada',
            ],
            [
                'id' => 151,
                'country_id' => 195,
                'name' => 'Guadalajara',
            ],
            [
                'id' => 152,
                'country_id' => 195,
                'name' => 'Guipuzcoa',
            ],
            [
                'id' => 153,
                'country_id' => 195,
                'name' => 'Huelva',
            ],
            [
                'id' => 154,
                'country_id' => 195,
                'name' => 'Huesca',
            ],
            [
                'id' => 155,
                'country_id' => 195,
                'name' => 'Jaen',
            ],
            [
                'id' => 156,
                'country_id' => 195,
                'name' => 'La Rioja',
            ],
            [
                'id' => 157,
                'country_id' => 195,
                'name' => 'Las Palmas',
            ],
            [
                'id' => 158,
                'country_id' => 195,
                'name' => 'Leon',
            ],
            [
                'id' => 159,
                'country_id' => 195,
                'name' => 'Lleida',
            ],
            [
                'id' => 160,
                'country_id' => 195,
                'name' => 'Lugo',
            ],
            [
                'id' => 161,
                'country_id' => 195,
                'name' => 'Madrid',
            ],
            [
                'id' => 162,
                'country_id' => 195,
                'name' => 'Malaga',
            ],
            [
                'id' => 163,
                'country_id' => 195,
                'name' => 'Melilla',
            ],
            [
                'id' => 164,
                'country_id' => 195,
                'name' => 'Murcia',
            ],
            [
                'id' => 165,
                'country_id' => 195,
                'name' => 'Navarra',
            ],
            [
                'id' => 166,
                'country_id' => 195,
                'name' => 'Ourense',
            ],
            [
                'id' => 167,
                'country_id' => 195,
                'name' => 'Palencia',
            ],
            [
                'id' => 168,
                'country_id' => 195,
                'name' => 'Pontevedra',
            ],
            [
                'id' => 169,
                'country_id' => 195,
                'name' => 'Salamanca',
            ],
            [
                'id' => 170,
                'country_id' => 195,
                'name' => 'Santa Cruz de Tenerife',
            ],
            [
                'id' => 171,
                'country_id' => 195,
                'name' => 'Segovia',
            ],
            [
                'id' => 172,
                'country_id' => 195,
                'name' => 'Sevilla',
            ],
            [
                'id' => 173,
                'country_id' => 195,
                'name' => 'Soria',
            ],
            [
                'id' => 174,
                'country_id' => 195,
                'name' => 'Tarragona',
            ],
            [
                'id' => 175,
                'country_id' => 195,
                'name' => 'Teruel',
            ],
            [
                'id' => 176,
                'country_id' => 195,
                'name' => 'Toledo',
            ],
            [
                'id' => 177,
                'country_id' => 195,
                'name' => 'Valencia',
            ],
            [
                'id' => 178,
                'country_id' => 195,
                'name' => 'Valladolid',
            ],
            [
                'id' => 179,
                'country_id' => 195,
                'name' => 'Vizcaya',
            ],
            [
                'id' => 180,
                'country_id' => 195,
                'name' => 'Zamora',
            ],
            [
                'id' => 181,
                'country_id' => 195,
                'name' => 'Zaragoza',
            ],
        ]);

    }
}
