<?php

use Illuminate\Database\Seeder;
use App\Disease;
class DiseaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Disease::create([
            'name' => "Hepatitis A and E",
            'description' => "Both hepatitis A and E are viral diseases that interfere with the functioning of the liver. Hepatitis is spread through the consumption of food or water contaminated with fecal matter in areas with poor sanitation. Infected individuals generally exhibit symptoms of fever, jaundice, abdominal pain and diarrhea.",
        ]);
        Disease::create([
            'name' => "Typhoid fever",
            'description' => "The bacteria that causes typhoid fever is present in many Southeast Asian countries such as Burma in areas where there is poor water and sewage sanitation. Floods in these areas can also quickly spread the bacteria. Burma has suffered from heavy flooding since 2015.",
        ]);
        Disease::create([
            'name' => "Cholera",
            'description' => "A diarrheal disease caused by the bacterium Vibrio cholera. An average of five to ten percent of those infected will have severe symptoms characterized by severe watery diarrhea, vomiting and leg cramps. Rapid loss of bodily fluids leads to dehydration and shock and can lead to death within hours without treatment.",
        ]);
        Disease::create([
            'name' => "Japanese Encephalitis",
            'description' => "The leading cause of vaccine-preventable encephalitis in Asia, Japanese encephalitis is generally contracted through mosquitos.",
        ]);
        Disease::create([
            'name' => "Malaria",
            'description' => "A mosquito-borne disease caused by a parasite. Individuals who contract malaria suffer from symptoms such as fever, chills and flu-like illness. Malaria is one of the most deadly diseases in Burma.",
        ]);
    }
}
