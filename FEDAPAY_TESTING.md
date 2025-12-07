# Guide de test FedaPay en local

## Problème : Transaction échouée

Si vous voyez "Transaction échouée" dans l'interface FedaPay, cela peut être dû à plusieurs raisons :

### 1. Callback URL non accessible (Problème principal en local)

**Problème** : FedaPay doit pouvoir accéder à votre URL de callback depuis Internet. Si vous êtes en local (`http://127.0.0.1:8000`), FedaPay ne peut pas y accéder.

**Solution** : Utiliser un tunnel comme ngrok pour exposer votre application localement :

```bash
# Installer ngrok (si pas déjà installé)
# Télécharger depuis https://ngrok.com/

# Lancer ngrok pour exposer le port 8000
ngrok http 8000
```

Vous obtiendrez une URL comme `https://xxxx-xx-xx-xx-xx.ngrok-free.app`

**Important** : Mettez à jour votre `.env` avec l'URL ngrok :
```env
APP_URL=https://xxxx-xx-xx-xx-xx.ngrok-free.app
```

Puis redémarrez votre serveur Laravel.

### 2. Numéros de téléphone de test

Pour tester en mode sandbox, utilisez des numéros de test valides. FedaPay accepte généralement :
- Format : +229XXXXXXXXX (10 chiffres après +229)
- Exemples de numéros de test : +2290164000001, +2290166000001

### 3. Vérification de la configuration

Assurez-vous que :
- `FEDAPAY_API_KEY` est correcte (clé sandbox pour les tests)
- `FEDAPAY_ENVIRONMENT=sandbox` pour les tests
- `APP_URL` dans `.env` pointe vers une URL accessible publiquement

### 4. Logs pour déboguer

Vérifiez les logs dans `storage/logs/laravel.log` pour voir :
- Les erreurs détaillées de FedaPay
- Les données reçues dans le callback
- Le statut des transactions

### 5. Test en production

Pour un test réel, vous devez :
1. Déployer votre application sur un serveur accessible publiquement
2. Utiliser les clés API de production (`FEDAPAY_ENVIRONMENT=live`)
3. Utiliser de vrais numéros de téléphone

## Commandes utiles

```bash
# Vider le cache de configuration
php artisan config:clear

# Voir les routes
php artisan route:list --name=payment

# Voir les logs en temps réel
tail -f storage/logs/laravel.log
```

