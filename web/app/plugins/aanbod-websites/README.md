# Aanbod Websites Plugin

WordPress plugin voor het beheren en verkopen van website templates met een checkout systeem.

## Functionaliteit

### Custom Post Types
- **Websites**: Custom post type voor website aanbod met featured image, excerpt en pricing
- **Bestellingen**: Intern post type voor het opslaan van klantbestellingen

### Taxonomieën
- Website Categorieën (hiërarchisch)
- Website Tags (niet-hiërarchisch)

### Pakketten Systeem
Beheer verschillende pakketten per website via `Websites > Pakketten`:
- Naam, beschrijving en prijs per pakket
- Features lijst
- Klanten kunnen pakket selecteren tijdens checkout

### Extra Opties
Twee soorten extra opties:
- **Globale opties**: Beschikbaar voor alle websites (`Websites > Globale Extra Opties`)
- **Website-specifieke opties**: Alleen voor specifieke website (in website edit scherm)

### Checkout Systeem
Configureerbaar checkout formulier via `Websites > Checkout Instellingen`:
- Aangepaste velden toevoegen/verwijderen
- Veldtypes: tekst, email, telefoon, textarea, nummer
- Verplichte velden markeren
- Velden op 50% of 100% breedte

## Shortcodes

### `[website_cta]`
CTA knop om website te selecteren en naar checkout te gaan.

**Attributen:**
- `text`: Tekst op de knop (default: "Website Bestellen")
- `checkout_page`: Slug van checkout pagina (default: "checkout")
- `website_id`: Specifieke website ID (optioneel, gebruikt huidige post)

### `[website_packages]`
Toont alle beschikbare pakketten voor een website.

**Attributen:**
- `website_id`: Website ID (optioneel, gebruikt huidige post)
- `checkout_page`: Slug van checkout pagina (default: "checkout")
- `button_text`: Tekst op pakket knoppen (default: "Kies dit pakket")

### `[website_checkout]`
Toont het checkout formulier. Vereist een geselecteerde website in de sessie.

**Geen attributen**

## Gebruikersflow

1. Klant bekijkt website post en klikt op CTA knop OF kiest een pakket
2. Website wordt opgeslagen in sessie
3. Klant wordt doorgestuurd naar checkout pagina
4. Klant vult gegevens in en plaatst bestelling
5. Bestelling wordt opgeslagen als `website_order` post type
6. Email notificatie naar admin en klant

## Block Patterns

De plugin registreert automatisch block patterns vanuit de `/patterns/` directory:
- `single-website.php` - Voor single website weergave
- `archive-websites.php` - Voor website archief pagina

## Admin Menu Structuur

```
Websites (hoofdmenu)
├── Alle Websites
├── Nieuwe Toevoegen
├── Categorieën
├── Tags
├── Bestellingen
├── Pakketten
├── Checkout Instellingen
└── Globale Extra Opties
```

## Technische Details

- **Sessies**: Gebruikt PHP sessies voor het opslaan van geselecteerde website/pakket
- **AJAX**: Alle checkout interacties via AJAX
- **Email**: Automatische notificaties bij nieuwe bestellingen
- **Assets**: Separate CSS/JS voor CTA, packages en checkout
