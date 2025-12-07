# Configuration FedaPay pour le système de paiement

## Installation

Le package FedaPay a été installé via Composer :
```bash
composer require fedapay/fedapay-php
```

## Configuration

### 1. Variables d'environnement

Ajoutez les variables suivantes dans votre fichier `.env` :

```env
# FedaPay Configuration
FEDAPAY_API_KEY=votre_cle_api_fedapay
FEDAPAY_ENVIRONMENT=sandbox
```

**Note :**
- `FEDAPAY_API_KEY` : Votre clé API FedaPay (obtenue depuis votre compte FedaPay)
- `FEDAPAY_ENVIRONMENT` : 
  - `sandbox` : Pour les tests (développement)
  - `live` : Pour la production

### 2. Obtenir vos clés API FedaPay

1. Créez un compte sur [FedaPay](https://fedapay.com)
2. Accédez à votre tableau de bord
3. Récupérez votre clé API dans la section "API Keys"
4. Pour les tests, utilisez les clés de test (sandbox)
5. Pour la production, utilisez les clés de production (live)

### 3. Migration de la base de données

La migration a été créée et exécutée. La table `payments` contient :
- `user_id` : ID de l'utilisateur
- `contenu_id` : ID du contenu
- `transaction_id` : ID de transaction FedaPay
- `feda_customer_id` : ID client FedaPay
- `amount` : Montant (100 FCFA)
- `currency` : Devise (XOF)
- `status` : Statut du paiement (pending, approved, failed, cancelled)
- `payment_method` : Méthode de paiement
- `description` : Description
- `paid_at` : Date de paiement

## Fonctionnement

### Flux de paiement

1. **Utilisateur authentifié** clique sur "Voir les détails" d'un contenu
2. Si l'utilisateur n'a pas encore payé, une page de paiement s'affiche
3. L'utilisateur clique sur "Payer 100 FCFA pour accéder"
4. Redirection vers la page de paiement FedaPay
5. L'utilisateur effectue le paiement via mobile money ou carte bancaire
6. Après paiement, redirection vers la page de détails du contenu
7. Le contenu complet est maintenant accessible

### Routes créées

- `GET /payment/initiate/{contenuId}` : Initialise le paiement (protégée par auth)
- `GET /payment/callback` : Callback après paiement (protégée par auth)

### Contrôleurs

- `PaymentController` : Gère l'initialisation et le callback des paiements
- `ContenusController` : Modifié pour vérifier le statut de paiement avant d'afficher le contenu

### Modèle

- `Payment` : Modèle Eloquent pour gérer les transactions de paiement

## Test en mode sandbox

Pour tester le système :

1. Configurez `FEDAPAY_ENVIRONMENT=sandbox` dans votre `.env`
2. Utilisez les clés API de test fournies par FedaPay
3. Testez avec les numéros de test fournis par FedaPay

## Production

Avant de passer en production :

1. Changez `FEDAPAY_ENVIRONMENT=live` dans votre `.env`
2. Utilisez vos clés API de production
3. Testez soigneusement le flux de paiement
4. Vérifiez que les callbacks fonctionnent correctement

## Notes importantes

- Le montant est fixé à **100 FCFA** par contenu
- Un utilisateur ne paie qu'une seule fois par contenu
- Les paiements sont enregistrés en base de données pour traçabilité
- Le statut du paiement est vérifié à chaque accès au contenu

