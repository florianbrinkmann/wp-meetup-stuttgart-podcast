# WordPress Meetup Stuttgart

## Prepare (Flo)

1. Docker starten
2. WordPress installieren

## Plugin file (Matthias)

1. Plugin Header
2. Namespace
3. In WordPress: Plugin aktivieren

## Custom Post Type (Flo)

1. Namespace
2. `function register_podcast_cpt()`
3. `function init()`
   1. What is an action

## Plugin file (Matthias)

1. `function init()`
2. Add CPT include & `WMSP\CPT\init()` call
3. In WordPress: Show Podcast Menu/List View

## Editor (Flo)

1. Add new Podcast
   1. Add Enclosure URL as post-meta (`wmsp_enclosure`)
2. Publish
3. Show Post

## Frontend (Matthias)

1. `function add_player` (without `before` & `after`)
2. `function init`
   1. Explain filters
3. Show Frontend with embedded player
4. Add Frontend include & `WMSP\Frontend\init()` call

## Admin (Flo)

1. `function register_settings()` (without sanitize)
2. `function field()`
3. sanitize
4. `function init()`
5. Add Admin include & `WMSP\Admin\init()` call
6. Open Settings/change Settings


## Frontend (Matthias)

1. Implement `before` & `after` code in `function add_player`
2. Show frontend
3. Change Settings and show changed result in frontend

## Frontend (Flo)

1. Add styling `function enqueue_style()`
2. Explain `wp_enqueue_style`
3. Add and explain `wp_enqueue_scripts` to `init`
4. Show frontend/archive

## Endpoint (optional) (Matthias)

1. `function register_rest_endpoint()`
2. Explain `register_rest_route`
3. `function list_podcasts()` without filter
4. Show output with missing "enclosure"
5. Add and explain `apply_filters`
6. `function extend_posts_data`
7. Show filtered output