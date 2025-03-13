<?php

// Enqueue admin styles
add_action( 'admin_enqueue_scripts', 'load_admin_style' );
function load_admin_style() {
    wp_enqueue_style( 'admin_css', get_template_directory_uri() . '/css/admin-style.css', false, rand(1, 999) );
}

// Enqueue theme styles
function my_api_theme_enqueue_scripts() {
    wp_enqueue_style('tco-api-theme-style', get_stylesheet_uri());
}
add_action('wp_enqueue_scripts', 'my_api_theme_enqueue_scripts');

// Featured Image
add_theme_support('post-thumbnails');

// Disable Block Editor
add_filter('use_block_editor_for_post', '__return_false');


// Register custom post types
function register_custom_post_types() {
    // Events/RSVP Custom Post Type
    register_post_type('events_rsvp', [
        'labels' => [
            'name' => 'Events/RSVP',
            'singular_name' => 'Event/RSVP',
        ],
        'public' => true,
        'show_in_rest' => true, 
        'supports' => ['title', 'thumbnail', 'custom-fields'], 
        'meta_box_cb' => false, 
        'has_archive' => true,
        'show_ui' => true,
    ]);

    // Notifications Custom Post Type
    register_post_type('notifications', [
        'labels' => [
            'name' => 'Notifications',
            'singular_name' => 'Notification',
        ],
        'public' => true,
        'show_in_rest' => true, 
        'supports' => ['title', 'editor'], 
        'has_archive' => true,
        'show_ui' => true,
    ]);
    
    // Notes Custom Post Type
    register_post_type('notes', [
        'labels' => [
            'name' => 'Notes',
            'singular_name' => 'Note',
        ],
        'public' => true,
        'show_in_rest' => true, 
        'supports' => ['title', 'editor', 'custom-fields'], 
        'has_archive' => true,
        'show_ui' => true,
        'capability_type' => 'post',
        'map_meta_cap' => true,
        'rest_controller_class' => 'WP_REST_Posts_Controller',
    ]);

    // Prayer Request Custom Post Type
    register_post_type('prayer_request', [
        'labels' => [
            'name' => 'Prayer Requests',
            'singular_name' => 'Prayer Request',
        ],
        'public' => true,
        'show_in_rest' => true, 
        'supports' => ['title', 'custom-fields'],
        'has_archive' => true,
        'show_ui' => true,
        'capability_type' => 'post',
        'map_meta_cap' => true,
        'rest_controller_class' => 'WP_REST_Posts_Controller',
    ]);
    
    // FCM Token
    register_post_type('fcm_token', [
        'labels' => [
            'name' => 'FCM Tokens',
            'singular_name' => 'FCM Token',
        ],
        'public' => true,
        'show_in_rest' => true, 
        'supports' => ['title', 'custom-fields'], 
        'has_archive' => true,
        'show_ui' => true,
        'capability_type' => 'post',
        'map_meta_cap' => true,
        'rest_controller_class' => 'WP_REST_Posts_Controller',
    ]);
    
    // Contact Form Custom Post Type
    register_post_type('contact_form', [
        'labels' => [
            'name' => 'Contact Form',
            'singular_name' => 'Contact Form',
        ],
        'public' => true,
        'show_in_rest' => true, 
        'supports' => ['title', 'custom-fields'], 
        'has_archive' => true,
        'show_ui' => true,
        'capability_type' => 'post',
        'map_meta_cap' => true,
        'rest_controller_class' => 'WP_REST_Posts_Controller',
    ]);
    
    // Media Custom Post Type
    register_post_type('media_videos', [
        'labels' => [
            'name'          => 'Media (Videos)',
            'singular_name' => 'Media (Video)',
        ],
        'public'        => true,
        'show_in_rest'  => true, 
        'supports'      => ['title', 'thumbnail', 'custom-fields'], 
        'meta_box_cb'   => false, 
        'has_archive'   => true,
        'show_ui'       => true,
        'taxonomies'    => ['category'],
        'rest_controller_class' => 'WP_REST_Posts_Controller',
    ]);
}
add_action('init', 'register_custom_post_types');

// Register custom meta fields
function register_custom_meta_fields() {
    // Events/RSVP Meta Fields
    register_post_meta('events_rsvp', 'register_link', [
        'type' => 'string',
        'description' => 'Link to register for the event',
        'single' => true,
        'show_in_rest' => true, 
    ]);
    register_post_meta('events_rsvp', 'visit_link', [
        'type' => 'string',
        'description' => 'Link to visit event details',
        'single' => true,
        'show_in_rest' => true,
    ]);
    
    // Notes Meta Fields
    register_post_meta('notes', 'author_id', [
        'type' => 'string',
        'description' => 'Author Identifier',
        'single' => true,
        'show_in_rest' => true, 
    ]);
    
    // Prayer Request Meta Fields
    register_post_meta('prayer_request', 'anonymous_post', [
        'type' => 'boolean',
        'description' => 'Is this an anonymous post?',
        'single' => true,
        'show_in_rest' => true,
    ]);
    register_post_meta('prayer_request', 'name', [
        'type' => 'string',
        'description' => 'Name of the person submitting the request',
        'single' => true,
        'show_in_rest' => true,
    ]);
    register_post_meta('prayer_request', 'email', [
        'type' => 'string',
        'description' => 'Email of the person submitting the request',
        'single' => true,
        'show_in_rest' => true,
    ]);
    register_post_meta('prayer_request', 'content', [
        'type' => 'string',
        'description' => 'Prayer request content',
        'single' => true,
        'show_in_rest' => true,
    ]);
    
    // FCM Token Meta Fields
    register_post_meta('fcm_token', 'uuid', [
        'type' => 'string',
        'description' => 'uuid',
        'single' => true,
        'show_in_rest' => true,
    ]);
    register_post_meta('fcm_token', 'fcm_token', [
        'type' => 'string',
        'description' => 'fcm_token',
        'single' => true,
        'show_in_rest' => true,
    ]);
    register_post_meta('fcm_token', 'apns_token', [
        'type' => 'string',
        'description' => 'fcm_token',
        'single' => true,
        'show_in_rest' => true,
    ]);
    register_post_meta('fcm_token', 'platform', [
        'type' => 'string',
        'description' => 'fcm_token',
        'single' => true,
        'show_in_rest' => true,
    ]);

    // Contact Form Meta Fields
    register_post_meta('contact_form', 'first_name', [
        'type' => 'string',
        'description' => 'first name',
        'single' => true,
        'show_in_rest' => true,
    ]);
    register_post_meta('contact_form', 'last_name', [
        'type' => 'string',
        'description' => 'last name',
        'single' => true,
        'show_in_rest' => true,
    ]);
    register_post_meta('contact_form', 'email', [
        'type' => 'string',
        'description' => 'email address',
        'single' => true,
        'show_in_rest' => true,
    ]);
    register_post_meta('contact_form', 'phone', [
        'type' => 'string',
        'description' => 'phone number',
        'single' => true,
        'show_in_rest' => true,
    ]);
    register_post_meta('contact_form', 'comments', [
        'type' => 'string',
        'description' => 'comments',
        'single' => true,
        'show_in_rest' => true,
    ]);

    // Media Meta Fields
    register_post_meta('media_videos', 'youtube_link', [
        'type' => 'string',
        'description' => 'Youtube URL/Link',
        'single' => true,
        'show_in_rest' => true,
    ]);
    register_post_meta('media_videos', 'date', [
        'type' => 'string',
        'description' => 'Date',
        'single' => true,
        'show_in_rest' => true,
    ]);
    
}
add_action('init', 'register_custom_meta_fields');



// Allow public submissions for Contact Form
function handle_contact_form_submission(WP_REST_Request $request) {
    $title = sanitize_text_field($request->get_param('title'));
    $first_name = sanitize_text_field($request->get_param('first_name'));
    $last_name = sanitize_text_field($request->get_param('last_name'));
    $email = sanitize_text_field($request->get_param('email'));
    $phone = sanitize_text_field($request->get_param('phone'));
    $comments = sanitize_text_field($request->get_param('comments'));

    if (empty($title)) {
        return new WP_Error('missing_fields', 'Title is required.', ['status' => 400]);
    }

    $post_id = wp_insert_post([
        'post_type' => 'contact_form',
        'post_title' => $title,
        'post_status' => 'publish', 
    ]);

    if (is_wp_error($post_id)) {
        return new WP_Error('insert_failed', 'Failed to create the contact form.', ['status' => 500]);
    }

    update_post_meta($post_id, 'first_name', $first_name);
    update_post_meta($post_id, 'last_name', $last_name);
    update_post_meta($post_id, 'email', $email);
    update_post_meta($post_id, 'phone', $phone);
    update_post_meta($post_id, 'comments', $comments);

    return new WP_REST_Response(['message' => 'Contact Form submitted successfully.', 'post_id' => $post_id], 201);
}

// Allow public submissions for Prayer Requests
function handle_prayer_request_submission(WP_REST_Request $request) {
    $title = sanitize_text_field($request->get_param('title'));
    $content = sanitize_text_field($request->get_param('content'));
    $anonymous = filter_var($request->get_param('anonymous_post'), FILTER_VALIDATE_BOOLEAN);
    $name = $anonymous ? 'Anonymous' : sanitize_text_field($request->get_param('name'));
    $email = $anonymous ? '' : sanitize_email($request->get_param('email'));

    if (empty($title) || empty($content)) {
        return new WP_Error('missing_fields', 'Title and content are required.', ['status' => 400]);
    }

    $post_id = wp_insert_post([
        'post_type' => 'prayer_request',
        'post_title' => $title,
        'post_content' => $content,
        'post_status' => 'publish', 
    ]);

    if (is_wp_error($post_id)) {
        return new WP_Error('insert_failed', 'Failed to create the prayer request.', ['status' => 500]);
    }

    update_post_meta($post_id, 'anonymous_post', $anonymous);
    update_post_meta($post_id, 'name', $name);
    update_post_meta($post_id, 'email', $email);

    return new WP_REST_Response(['message' => 'Prayer request submitted successfully.', 'post_id' => $post_id], 201);
}

// Allow public submissions for Notes
function handle_notes_submission(WP_REST_Request $request) {
    $title = sanitize_text_field($request->get_param('title'));
    $content = sanitize_text_field($request->get_param('content'));
    $author_id = sanitize_text_field($request->get_param('author_id'));

    if (empty($title) || empty($content)) {
        return new WP_Error('missing_fields', 'Title and content are required.', ['status' => 400]);
    }

    $post_id = wp_insert_post([
        'post_type' => 'notes',
        'post_title' => $title,
        'post_content' => $content,
        'post_status' => 'publish', 
    ]);
    
    update_post_meta($post_id, 'author_id', $author_id);

    if (is_wp_error($post_id)) {
        return new WP_Error('insert_failed', 'Failed to create the note.', ['status' => 500]);
    }

    return new WP_REST_Response(['message' => 'Note submitted successfully.', 'post_id' => $post_id], 201);
}

// Allow public submissions for FCM Token
function handle_fcm_token_submission(WP_REST_Request $request) {
    $title = sanitize_text_field($request->get_param('title'));
    $uuid = sanitize_text_field($request->get_param('uuid'));
    $fcm_token = sanitize_text_field($request->get_param('fcm_token'));
    $apns_token = sanitize_text_field($request->get_param('apns_token'));
    $platform = sanitize_text_field($request->get_param('platform'));

    if (empty($uuid)) {
        return new WP_Error('missing_fields', 'UUID is required.', ['status' => 400]);
    }

    $existing_query = new WP_Query([
        'post_type' => 'fcm_token',
        'meta_query' => [
            [
                'key' => 'uuid',
                'value' => $uuid,
                'compare' => '='
            ]
        ],
        'posts_per_page' => 1,
    ]);

    if ($existing_query->have_posts()) {
        $existing_post = $existing_query->posts[0];
        $post_id = $existing_post->ID;

        wp_update_post([
            'ID' => $post_id,
            'post_title' => $title,
        ]);

        update_post_meta($post_id, 'fcm_token', $fcm_token);
        update_post_meta($post_id, 'apns_token', $apns_token);
        update_post_meta($post_id, 'platform', $platform);

        return new WP_REST_Response(['message' => 'FCM Token updated successfully.', 'post_id' => $post_id], 200);
    } else {
        $post_id = wp_insert_post([
            'post_type' => 'fcm_token',
            'post_title' => $title,
            'post_status' => 'publish', 
        ]);

        if (is_wp_error($post_id)) {
            return new WP_Error('insert_failed', 'Failed to create the FCM Token.', ['status' => 500]);
        }

        update_post_meta($post_id, 'uuid', $uuid);
        update_post_meta($post_id, 'fcm_token', $fcm_token);
        update_post_meta($post_id, 'apns_token', $apns_token);
        update_post_meta($post_id, 'platform', $platform);

        return new WP_REST_Response(['message' => 'FCM Token submitted successfully.', 'post_id' => $post_id], 201);
    }
}

function register_fcm_token_endpoint() {
    register_rest_route('custom/v1', '/fcm-token', [
        'methods' => 'POST',
        'callback' => 'handle_fcm_token_submission',
        'permission_callback' => '__return_true', 
    ]);
}
add_action('rest_api_init', 'register_fcm_token_endpoint');


// Register custom REST API route
function register_route() {
    register_rest_route('custom/v1', '/prayer-request', [
        'methods' => 'POST',
        'callback' => 'handle_prayer_request_submission',
        'permission_callback' => '__return_true', 
    ]);
    register_rest_route('custom/v1', '/notes', [
        'methods' => 'POST',
        'callback' => 'handle_notes_submission',
        'permission_callback' => '__return_true', 
    ]);
    register_rest_route('custom/v1', '/fcm_token', [
        'methods' => 'POST',
        'callback' => 'handle_fcm_token_submission',
        'permission_callback' => '__return_true', 
    ]);
    register_rest_route('custom/v1', '/contact_form', [
        'methods' => 'POST',
        'callback' => 'handle_contact_form_submission',
        'permission_callback' => '__return_true', 
    ]);
}
add_action('rest_api_init', 'register_route');


// Add custom meta boxes for Notifications
function notifications_meta_box($post) {
    ?>
    <ul class="list_notes">
        <li><span class="code_notes">id</span> : primary key | WP Post ID</li>
        <li><span class="code_notes">title</span> : string | WP Post Title</li>
        <li><span class="code_notes">content</span> : string | WP Post Content</li>
    </ul>
    <?php
}
function notifications_notes_meta_boxes() {
    add_meta_box('notifications_notes', 'NOTES', 'notifications_meta_box', 'notifications', 'normal');
}
add_action('add_meta_boxes', 'notifications_notes_meta_boxes');

// Add custom meta boxes for Notes
function notes_meta_box($post) {
    ?>
    <ul class="list_notes">
        <li><span class="code_notes">id</span> : primary key | WP Post ID</li>
        <li><span class="code_notes">title</span> : string | WP Post Title</li>
        <li><span class="code_notes">content</span> : string | WP Post Content</li>
    </ul>
    <p class="paragraph_notes">Custom Fields:</p>
    <ul class="list_notes">
        <li><span class="code_notes">author_id</span> : string | Author Identifier</li>
    </ul>

    <?php
}
function notes_notes_meta_boxes() {
    add_meta_box('notes_notes', 'NOTES', 'notes_meta_box', 'notes', 'normal');
}
add_action('add_meta_boxes', 'notes_notes_meta_boxes');

// Add custom meta boxes for Events
function events_rsvp_meta_box($post) {
    ?>
    <ul class="list_notes">
        <li><span class="code_notes">id</span> : primary key | WP Post ID</li>
        <li><span class="code_notes">title</span> : string | WP Post Title</li>
        <li><span class="code_notes">featured_image</span> : file | WP Post Featured Image</li>
    </ul>
    <hr />
    <p class="paragraph_notes">Custom Fields:</p>
    <ul class="list_notes">
        <li><span class="code_notes">register_link</span> : string | Event Registration Link</li>
        <li><span class="code_notes">visit_link</span> : string | Event  Details</li>
    </ul>
    <?php
}
function events_rsvp_notes_meta_boxes() {
    add_meta_box('events_rsvp_notes', 'NOTES', 'events_rsvp_meta_box', 'events_rsvp', 'normal');
}
add_action('add_meta_boxes', 'events_rsvp_notes_meta_boxes');

// Add custom meta boxes for Prayer Requests
function prayer_requests_meta_box($post) {
    ?>
    <ul class="list_notes">
        <li><span class="code_notes">id</span> : primary key | WP Post ID</li>
    </ul>
    <p class="paragraph_notes">Custom Fields:</p>
    <ul class="list_notes">
        <li><span class="code_notes">anonymous_post</span> : boolean | true / false</li>
        <li><span class="code_notes">name</span> : string | user full name</li>
        <li><span class="code_notes">email</span> : string | user email</li>
        <li><span class="code_notes">content</span> : string | prayer or praise content</li>
    </ul>

    <?php
}
function prayer_requests_notes_meta_boxes() {
    add_meta_box('prayer_requests_notes', 'NOTES', 'prayer_requests_meta_box', 'prayer_request', 'normal');
}
add_action('add_meta_boxes', 'prayer_requests_notes_meta_boxes');

// Add custom meta boxes for FCM Token
function fcm_token_meta_box($post) {
    ?>
    <p class="paragraph_notes">Custom Fields:</p>
    <ul class="list_notes">
        <li><span class="code_notes">uuid</span> : boolean | true / false</li>
        <li><span class="code_notes">fcm_token</span> : string | nullable</li>
        <li><span class="code_notes">apns_token</span> : string | nullable</li>
        <li><span class="code_notes">platform</span> : string </li>
    </ul>

    <?php
}
function fcm_token_notes_meta_boxes() {
    add_meta_box('fcm_token_notes', 'NOTES', 'fcm_token_meta_box', 'fcm_token', 'normal');
}
add_action('add_meta_boxes', 'fcm_token_notes_meta_boxes');


// Add custom meta boxes for Contact Form
function contact_form_meta_box($post) {
    ?>
    <ul class="list_notes">
        <li><span class="code_notes">id</span> : primary key | WP Post ID</li>
    </ul>
    <p class="paragraph_notes">Custom Fields:</p>
    <ul class="list_notes">
        <li><span class="code_notes">first_name</span> : string </li>
        <li><span class="code_notes">last_name</span> : string </li>
        <li><span class="code_notes">email</span> : string </li>
        <li><span class="code_notes">phone</span> : string </li>
        <li><span class="code_notes">comments</span> : string </li>
    </ul>

    <?php
}
function contact_form_notes_meta_boxes() {
    add_meta_box('contact_form_notes', 'NOTES', 'contact_form_meta_box', 'contact_form', 'normal');
}
add_action('add_meta_boxes', 'contact_form_notes_meta_boxes');


// Add custom meta boxes for Media
function media_videos_meta_box($post) {
    ?>
    <ul class="list_notes">
        <li><span class="code_notes">id</span> : primary key | WP Post ID</li>
        <li><span class="code_notes">title</span> : string | WP Post Title</li>
        <li><span class="code_notes">categories</span> : string | WP Post Categories</li>
        <li><span class="code_notes">featured_image</span> : url | WP Post Featured Image</li>
    </ul>
    <p class="paragraph_notes">Custom Fields:</p>
    <ul class="list_notes">
        <li><span class="code_notes">youtube_link</span> : string | youtube url/link</li>
        <li><span class="code_notes">date</span> : string | date</li>
    </ul>

    <?php
}
function media_videos_notes_meta_boxes() {
    add_meta_box('media_videos_notes', 'NOTES', 'media_videos_meta_box', 'media_videos', 'normal');
}
add_action('add_meta_boxes', 'media_videos_notes_meta_boxes');


// Filter the API response for the events_rsvp post type
function filter_events_rsvp_api_response($response, $post, $request) {
    $filtered_data = [
        'id' => $post->ID,
        'title' => $response->data['title']['rendered'], 
        'featured_image' => get_the_post_thumbnail_url($post->ID, 'full'), 
        'register_link' => get_post_meta($post->ID, 'register_link', true), 
        'visit_link' => get_post_meta($post->ID, 'visit_link', true), 
    ];
    return $filtered_data;
}
add_filter('rest_prepare_events_rsvp', 'filter_events_rsvp_api_response', 10, 3);

// Filter the API response for the notifications post type
function filter_notifications_api_response($response, $post, $request) {
    $filtered_data = [
        'id' => $post->ID,
        'title' => $response->data['title']['rendered'], 
        'content' => $response->data['content']['rendered'], 
    ];
    return $filtered_data;
}
add_filter('rest_prepare_notifications', 'filter_notifications_api_response', 10, 3);

// Filter the API response for the prayer request post type
function filter_prayer_request_api_response($response, $post, $request) {
    $filtered_data = [
        'id' => $post->ID,
        'anonymous_post' => get_post_meta($post->ID, 'anonymous_post', true),
        'name' => get_post_meta($post->ID, 'name', true),
        'email' => get_post_meta($post->ID, 'email', true),
        'content' => get_post_meta($post->ID, 'content', true),
    ];
    return $filtered_data;
}
add_filter('rest_prepare_prayer_request', 'filter_prayer_request_api_response', 10, 3);


// Filter the API response for the notes post type
function filter_notes_api_response($response, $post, $request) {
    $filtered_data = [
        'id' => $post->ID,
        'title' => $response->data['title']['rendered'], 
        'content' => $response->data['content']['rendered'], 
        'author_id' => get_post_meta($post->ID, 'author_id', true),
    ];
    return $filtered_data;
}
add_filter('rest_prepare_notes', 'filter_notes_api_response', 10, 3);

// Add custom query parameter for filtering by author_id
function add_author_id_filter_to_rest_query($args, $request) {
    // Check if the 'author_id' parameter exists in the request
    if (isset($request['author_id'])) {
        $meta_query = [
            'key' => 'author_id',
            'value' => $request['author_id'],
            'compare' => '='
        ];

        if (isset($args['meta_query'])) {
            $args['meta_query'][] = $meta_query;
        } else {
            $args['meta_query'] = [$meta_query];
        }
    }

    return $args;
}
add_filter('rest_notes_query', 'add_author_id_filter_to_rest_query', 10, 2);


// Filter the API response for the FCM Token post type
function filter_fcm_token_api_response($response, $post, $request) {
    $filtered_data = [
        'id' => $post->ID,
        'uuid' => get_post_meta($post->ID, 'uuid', true),
        'fcm_token' => get_post_meta($post->ID, 'fcm_token', true),
        'apns_token' => get_post_meta($post->ID, 'apns_token', true),
        'platform' => get_post_meta($post->ID, 'platform', true),
    ];
    return $filtered_data;
}
add_filter('rest_prepare_fcm_token', 'filter_fcm_token_api_response', 10, 3);

// Filter the API response for the Contact Form post type
function filter_contact_form_api_response($response, $post, $request) {
    $filtered_data = [
        'id' => $post->ID,
        'first_name' => get_post_meta($post->ID, 'first_name', true),
        'last_name' => get_post_meta($post->ID, 'last_name', true),
        'email' => get_post_meta($post->ID, 'email', true),
        'phone' => get_post_meta($post->ID, 'phone', true),
        'comments' => get_post_meta($post->ID, 'comments', true),
    ];
    return $filtered_data;
}
add_filter('rest_prepare_contact_form', 'filter_contact_form_api_response', 10, 3);

// Filter the API response for the media post type
function filter_media_videos_api_response($response, $post, $request) {
    $categories = get_the_category($post->ID);
    $category_data = [];
    
    if (!empty($categories)) {
        foreach ($categories as $category) {
            $category_data[] = [
                'id'   => $category->term_id,
                'name' => $category->name,
            ];
        }
    }
    
    $filtered_data = [
        'id' => $post->ID,
        'title' => $response->data['title']['rendered'], 
        'featured_image' => get_the_post_thumbnail_url($post->ID, 'full'),
        'categories'     => $category_data,
        'youtube_link' => get_post_meta($post->ID, 'youtube_link', true), 
        'date' => get_post_meta($post->ID, 'date', true), 
    ];
    return $filtered_data;
}
add_filter('rest_prepare_media_videos', 'filter_media_videos_api_response', 10, 3);


// API endpoint to delete a prayer request post
function delete_prayer_request(WP_REST_Request $request) {
    $post_id = $request->get_param('id');

    if (!is_numeric($post_id) || get_post_type($post_id) !== 'prayer_request') {
        return new WP_Error('invalid_post', 'Invalid prayer request ID.', ['status' => 400]);
    }

    if (!current_user_can('delete_post', $post_id)) {
        return new WP_Error('permission_denied', 'You are not allowed to delete this post.', ['status' => 403]);
    }

    $result = wp_delete_post($post_id, true); 

    if (!$result) {
        return new WP_Error('delete_failed', 'Failed to delete the prayer request.', ['status' => 500]);
    }

    return new WP_REST_Response(['message' => 'Prayer request deleted successfully.', 'post_id' => $post_id], 200);
}

// API endpoint to delete a note post
function delete_note(WP_REST_Request $request) {
    $post_id = $request->get_param('id');

    if (!is_numeric($post_id) || get_post_type($post_id) !== 'notes') {
        return new WP_Error('invalid_post', 'Invalid note ID.', ['status' => 400]);
    }

    if (!current_user_can('delete_post', $post_id)) {
        return new WP_Error('permission_denied', 'You are not allowed to delete this post.', ['status' => 403]);
    }

    $result = wp_delete_post($post_id, true); 

    if (!$result) {
        return new WP_Error('delete_failed', 'Failed to delete the note.', ['status' => 500]);
    }

    return new WP_REST_Response(['message' => 'Note deleted successfully.', 'post_id' => $post_id], 200);
}

function update_note_endpoint(WP_REST_Request $request) {
    $note_id = $request->get_param('id');
    $note_title = $request->get_param('title');
    $note_content = $request->get_param('content');
    $note_author_id = $request->get_param('author_id');

    $note = get_post($note_id);
    if (!$note || $note->post_type !== 'notes') {
        return new WP_Error('rest_post_invalid', 'Invalid note ID or post type.', ['status' => 404]);
    }

    if (!current_user_can('edit_post', $note_id)) {
        return new WP_Error('rest_forbidden', 'You are not allowed to update this note.', ['status' => 403]);
    }

    $update_data = [];
    if (!empty($note_title)) {
        $update_data['post_title'] = sanitize_text_field($note_title);
    }
    if (!empty($note_content)) {
        $update_data['post_content'] = sanitize_textarea_field($note_content);
    }

    if (!empty($update_data)) {
        $update_data['ID'] = $note_id;

        $updated_post_id = wp_update_post($update_data, true);

        if (is_wp_error($updated_post_id)) {
            return new WP_Error('rest_cannot_update', 'Failed to update the note.', ['status' => 500]);
        }

        return new WP_REST_Response([
            'message' => 'Note updated successfully.',
            'note_id' => $note_id,
            'author_id' => $note_author_id,
            'updated_fields' => $update_data,
        ], 200);
    }

    return new WP_Error('rest_no_data', 'No data provided to update.', ['status' => 400]);
}

// Register the API route
function register_delete_endpoint() {
    register_rest_route('custom/v1', '/prayer-request/delete', [
        'methods' => 'DELETE',
        'callback' => 'delete_prayer_request',
        'permission_callback' => function () {
            return current_user_can('delete_posts');
        },
    ]);
    register_rest_route('custom/v1', '/notes/delete', [
        'methods' => 'DELETE',
        'callback' => 'delete_note',
        'permission_callback' => function () {
            return current_user_can('delete_posts'); 
        },
    ]);
    register_rest_route('custom/v1', '/notes/update', [
        'methods' => 'POST', 
        'callback' => 'update_note_endpoint',
        'permission_callback' => function () {
            return is_user_logged_in(); 
        },
    ]);
}
add_action('rest_api_init', 'register_delete_endpoint');


function restrict_fcm_token_post_type_access() {
    if (current_user_can('administrator')) {
        add_action('admin_menu', function () {
            remove_submenu_page('edit.php?post_type=fcm_token', 'post-new.php?post_type=fcm_token');
        });

        add_action('load-post-new.php', function () {
            if (isset($_GET['post_type']) && $_GET['post_type'] === 'fcm_token') {
                wp_die(__('You do not have permission to add new posts for this post type.'));
            }
        });

        add_action('admin_init', function () {
            global $pagenow;
            if ($pagenow === 'post.php' || $pagenow === 'post-edit.php') {
                $post_id = isset($_GET['post']) ? intval($_GET['post']) : 0;
                if ($post_id) {
                    $post = get_post($post_id);
                    if ($post && $post->post_type === 'fcm_token') {
                        wp_die(__('You do not have permission to edit posts for this post type.'));
                    }
                }
            }
        });

        add_filter('post_row_actions', function ($actions, $post) {
            if ($post->post_type === 'fcm_token') {
                unset($actions['edit']);
                unset($actions['inline hide-if-no-js']);
            }
            return $actions;
        }, 10, 2);
    }
}
add_action('admin_init', 'restrict_fcm_token_post_type_access');

function restrict_fcm_token_post_update($data, $postarr) {
    if (current_user_can('administrator')) {
        if ($data['post_type'] === 'fcm_token') {
            wp_die(__('You do not have permission to update posts for this post type.'));
        }
    }

    return $data;
}
add_filter('wp_insert_post_data', 'restrict_fcm_token_post_update', 10, 2);



// Get Latest Notification post and return into array
function get_latest_notification_array() {
    $args = array(
        'post_type' => 'notifications', 
        'posts_per_page' => 1, 
        'post_status' => 'publish', 
        'orderby' => 'date', 
        'order' => 'DESC', 
    );

    $notifications_query = new WP_Query($args);

    $notification = array();

    if ($notifications_query->have_posts()) {
        while ($notifications_query->have_posts()) {
            $notifications_query->the_post();

            $notification = array(
                'title' => get_the_title(),
                'body'  => get_the_content(),
                'image' => 'https://app-newpsalmist-staging.thechurchonline.com/wp-content/uploads/2024/12/logo.png'
            );
        }
    }

    wp_reset_postdata();

    return $notification;
}



// Function to retrieve and send FCM notifications
function send_fcm_notifications($authorization_token) {
    $args = array(
        'post_type'      => 'fcm_token',  
        'posts_per_page' => -1,          
    );
    
    $notification = get_latest_notification_array();

    $query = new WP_Query($args);
    $tokens_status = []; 

    if ($query->have_posts()) :
        while ($query->have_posts()) : $query->the_post();
			
            // $token = get_post_meta(get_the_ID(), 'fcm_token', true) ?: convertAPNSToFCMToken($authorization_token, get_post_meta(get_the_ID(), 'apns_token', true));
            $token = get_post_meta(get_the_ID(), 'fcm_token', true) ?: get_post_meta(get_the_ID(), 'apns_token', true);
            $platform = get_post_meta(get_the_ID(), 'platform', true);
            $createdAt = get_the_date() . ' at ' . get_the_time();
			$updatedAt = get_the_modified_date('F j, Y') . ' at ' . get_the_modified_time('g:i a');
            if ($token) {
                $data = array(
                    'message' => array(
                        'token' => $token,
                        'notification' => $notification,
                        'android' => array(
                            'priority' => 'HIGH'
                        ),
                        'apns' => array(
                            'headers' => array(
                                'apns-priority' => '10'
                            ),
                            'payload' => array(
                                'aps' => array(
                                    'alert' => $notification
                                ),
                                'sound' => 'default',
                                'badge' => 1
                            )
                        )
                    )
                );

                $body = json_encode($data);

                $headers = array(
                    'Authorization' => 'Bearer ' . $authorization_token, 
                    'Content-Type'  => 'application/json',
                );

                $response = wp_remote_post('https://fcm.googleapis.com/v1/projects/new-psalmist-baptist-chu-d7a69/messages:send', array(
                    'method'    => 'POST',
                    'body'      => $body,
                    'headers'   => $headers,
                    'timeout'   => 15, 
                ));

                if (is_wp_error($response)) {
                    $status = 'Failed: ' . $response->get_error_message();
                } else {
                    $status_code = wp_remote_retrieve_response_code($response);
                    if ($status_code === 200) {
                        $status = '<span style="color:green;font-weight:700;">SUCCESS</span>';
                    } else {
                        $status = '<span style="color:red;">FAILED: ' . wp_remote_retrieve_response_message($response) . '</span>';
                    }
                }

                $tokens_status[] = array(
                    'token' => $token,
                    'status' => $status,
                    'platform' => $platform,
                    'created_at' => $createdAt,
					'updated_at' => $updatedAt,
                );
            }
        endwhile;
        wp_reset_postdata();

        return $tokens_status;

    else :
        return []; 
    endif;
}

// Add an admin menu and a button to trigger the function
function add_fcm_button_to_admin_menu() {
    add_menu_page(
        'Push Notifications',       
        'Push Notifications',         
        'manage_options',           
        'send_fcm_notifications',    
        'display_fcm_button',        
        'dashicons-email',           
        6                            
    );
}
add_action('admin_menu', 'add_fcm_button_to_admin_menu');

// Display the button and handle the POST request
function display_fcm_button() {
    $tokens_status = [];
    $authorization_token = '';

    if (isset($_POST['action']) && $_POST['action'] == 'send_fcm_notifications_action') {
        if (isset($_POST['send_fcm_notifications_nonce_field']) && wp_verify_nonce($_POST['send_fcm_notifications_nonce_field'], 'send_fcm_notifications_nonce')) {
            $authorization_token = sanitize_text_field($_POST['authorization_token']);
            $tokens_status = send_fcm_notifications($authorization_token);
        }
    }

    ?>
    <div class="wrap">
        <h1>Push Notifications</h1>
        <p>Send the latest post from custom post type "notifications".</p>
        <form method="post" action="">
            <input type="hidden" name="action" value="send_fcm_notifications_action">
            <?php wp_nonce_field('send_fcm_notifications_nonce', 'send_fcm_notifications_nonce_field'); ?>
            
            <p>
                <label for="authorization_token">Authorization Bearer Token:</label> <br />
                <input type="text" name="authorization_token" id="authorization_token" class="regular-text" value="<?php echo esc_attr($authorization_token); ?>" required>
            </p>
            <hr />
            <p>
                <input type="submit" value="Send Notifications" class="button button-primary">
            </p>
        </form>

        <?php if (!empty($tokens_status)): ?>
            <h2>FCM Tokens and Status:</h2>
            <table class="wp-list-table widefat fixed striped">
                <thead>
                    <tr>
                        <th>Token</th>
                        <th>Platform</th>
                        <th>Created At</th>
						<th>Updated At</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($tokens_status as $item): ?>
                        <tr>
                            <td><?php echo esc_html($item['token']); ?></td>
                            <td><?php echo esc_html($item['platform']); ?></td>
                            <td><?php echo esc_html($item['created_at']); ?></td>
							<td><?php echo esc_html($item['updated_at']); ?></td>
                            <td><?php echo $item['status']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php elseif (isset($_POST['action']) && $_POST['action'] == 'send_fcm_notifications_action'): ?>
            <p>No valid FCM tokens found for Android platform.</p>
        <?php endif; ?>
    </div>
    <?php
}


function convertAPNSToFCMToken($firebaseToken, $token) {
    // Prepare the data payload
    $data = [
        "application" => "com.newPsalmistBaptistChurch",
        "sandbox" => true,
        "apns_tokens" => [$token],
    ];

    $url = 'https://iid.googleapis.com/iid/v1:batchImport';

    // Set headers
    $headers = [
        "Content-Type: application/json",
        "Authorization: Bearer $firebaseToken",
        "access_token_auth: true"
    ];

    // Initialize cURL
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

    // Execute the request and get the response
    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        echo 'Curl error: ' . curl_error($ch);
        curl_close($ch);
        return;
    }

    curl_close($ch);

    // Log the response for debugging
    echo "Response conversion: $response\n";

    // Process the response
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    if ($httpCode == 200) {
        $responseBody = json_decode($response, true);

        if (isset($responseBody['results']) && is_array($responseBody['results'])) {
            $results = $responseBody['results'];
            if (!empty($results)) {
                $result = $results[0];

                // Extract the registration token
                if (isset($result['registration_token'])) {
                    $registrationToken = $result['registration_token'];					
					return $registrationToken;
                }
            }
        }
    }
}
