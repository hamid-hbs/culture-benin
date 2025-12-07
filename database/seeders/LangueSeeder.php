<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Langue;

class LangueSeeder extends Seeder
{
    public function run(): void
    {
        Langue::create(['nom' => 'Fon', 'code' => 'fon', 'description' => 'Langue la plus parlée au sud du Bénin.']);
        Langue::create(['nom' => 'Goun', 'code' => 'gun', 'description' => 'Langue parlée à Porto-Novo et environs.']);
        Langue::create(['nom' => 'Aïzo', 'code' => 'aiz', 'description' => 'Langue parlée dans la région d’Allada et Ouidah.']);
        Langue::create(['nom' => 'Mina', 'code' => 'min', 'description' => 'Langue du sud-ouest, proche de l’Éwé.']);
        Langue::create(['nom' => 'Adja', 'code' => 'adj', 'description' => 'Langue du Mono et Couffo.']);
        Langue::create(['nom' => 'Xwla', 'code' => 'xwl', 'description' => 'Langue côtière parlée à Grand-Popo.']);
        Langue::create(['nom' => 'Xweda', 'code' => 'xwe', 'description' => 'Langue parlée à Ouidah.']);
        Langue::create(['nom' => 'Yoruba', 'code' => 'yor', 'description' => 'Langue parlée dans l’Ouémé et le Plateau.']);
        Langue::create(['nom' => 'Nago', 'code' => 'nag', 'description' => 'Variante yoruba parlée au Plateau.']);
        Langue::create(['nom' => 'Idaasha', 'code' => 'ida', 'description' => 'Langue parlée à Dassa et Glazoué.']);
        Langue::create(['nom' => 'Ifè', 'code' => 'ife', 'description' => 'Langue parlée à Savè.']);
        Langue::create(['nom' => 'Mahi', 'code' => 'mah', 'description' => 'Langue du Zou et Collines.']);
        Langue::create(['nom' => 'Dendi', 'code' => 'den', 'description' => 'Langue parlée à Kandi, Malanville et Karimama.']);
        Langue::create(['nom' => 'Bariba', 'code' => 'bar', 'description' => 'Langue parlée à Parakou, Nikki, Kalalé.']);
        Langue::create(['nom' => 'Boo', 'code' => 'boo', 'description' => 'Langue du Borgou et de l’Alibori.']);
        Langue::create(['nom' => 'Zarma', 'code' => 'zar', 'description' => 'Langue parlée dans certaines zones du nord.']);
        Langue::create(['nom' => 'Fulfuldé', 'code' => 'ful', 'description' => 'Langue des communautés peulhs au nord.']);
        Langue::create(['nom' => 'Otammari', 'code' => 'otm', 'description' => 'Langue de la région de Natitingou.']);
        Langue::create(['nom' => 'Berba', 'code' => 'brb', 'description' => 'Langue de la région de Tanguiéta.']);
        Langue::create(['nom' => 'Lama', 'code' => 'lam', 'description' => 'Langue parlée dans le Nord-Ouest du Bénin.']);
        Langue::create(['nom' => 'Ditamari', 'code' => 'dit', 'description' => 'Langue de Boukoumbé et environs.']);
        Langue::create(['nom' => 'Waama', 'code' => 'waa', 'description' => 'Langue de la région de Tanguiéta.']);
        Langue::create(['nom' => 'Nateni', 'code' => 'ntn', 'description' => 'Langue de la région de Kouandé.']);
        Langue::create(['nom' => 'Gourmantché', 'code' => 'gou', 'description' => 'Langue parlée dans l’extrême nord du Bénin.']);
        Langue::create(['nom' => 'Koussountou', 'code' => 'kus', 'description' => 'Langue minoritaire du Bénin.']);
        Langue::create(['nom' => 'Weme (Ouémé)', 'code' => 'wem', 'description' => 'Langue parlée dans l’Ouémé.']);
        Langue::create(['nom' => 'Tori', 'code' => 'tor', 'description' => 'Langue parlée à Tori-Bossito.']);
        Langue::create(['nom' => 'Holou', 'code' => 'hol', 'description' => 'Langue proche du fon parlée dans le sud.']);
        Langue::create(['nom' => 'Saxwe', 'code' => 'sax', 'description' => 'Langue du sud-ouest du Bénin.']);
        Langue::create(['nom' => 'Ayizo-Gbe', 'code' => 'ayz', 'description' => 'Langue gbe parlée dans l’Atlantique.']);
    }
}
