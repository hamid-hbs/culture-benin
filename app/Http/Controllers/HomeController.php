<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use App\Models\Contenu;
use App\Models\User;
use App\Models\Region;
use App\Models\Langue;

class HomeController extends Controller
{
    public function index()
    {
        $totalContenus = Contenu::count();
        $totalUsers = User::count();
        $totalRegions = Region::count();
        $totalLangues = Langue::count();
        
        // Récupérer les langues parlées (qui ont des utilisateurs associés)
        $languesParlees = Langue::has('users')->count();
        
        // Langues non parlées (qui n'ont aucun utilisateur)
        $languesNonParlees = $totalLangues - $languesParlees;

        // Récupérer les contenus des 7 derniers jours
        $contenusParJour = Contenu::select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('COUNT(*) as total')
            )
            ->where('created_at', '>=', Carbon::now()->subDays(6)->startOfDay())
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();

        // Préparer les données pour le graphique (7 derniers jours)
        $dates = [];
        $totaux = [];
        
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i)->format('Y-m-d');
            $dates[] = Carbon::now()->subDays($i)->locale('fr')->isoFormat('ddd'); // Lun, Mar, etc.
            
            // Chercher le total pour cette date
            $contenu = $contenusParJour->firstWhere('date', $date);
            $totaux[] = $contenu ? $contenu->total : 0;
        }

        // Récupérer les utilisateurs des 12 derniers mois
        $usersParMois = User::select(
                DB::raw('MONTH(date_inscription) as mois'),
                DB::raw('COUNT(*) as total')
            )
            ->where('date_inscription', '>=', Carbon::now()->subMonths(11)->startOfMonth())
            ->groupBy('mois')
            ->orderBy('mois', 'asc')
            ->get();

        // Préparer les données pour le graphique utilisateurs
        $mois = [];
        $usersData = [];
        
        for ($i = 11; $i >= 0; $i--) {
            $monthNumber = Carbon::now()->subMonths($i)->month;
            $mois[] = Carbon::now()->subMonths($i)->locale('fr')->isoFormat('MMM');
            
            $user = $usersParMois->firstWhere('mois', $monthNumber);
            $usersData[] = $user ? $user->total : 0;
        }


        return view('welcome', compact('totalContenus', 'totalUsers', 'totalRegions', 'totalLangues', 'languesParlees', 'languesNonParlees', 'dates', 'totaux', 'mois', 'usersData'));

    }
}
