<?php

return [

	/*
	|--------------------------------------------------------------------------
	| Common
	|--------------------------------------------------------------------------
	*/

	'title' => 'Common',

	'languages' => [
		'language' => 'Language',
		/**
		 * Add the new language to this array.
		 * The key should have the same language code as the folder name.
		 * The string should be: 'Language-name-in-your-own-language (Language-name-in-English)'.
		 * Be sure to add the new language in alphabetical order.
		 */
		'langs' => [
			'ar' => 'Arabic',
			'da' => 'Danish',
			'de' => 'German',
			'en' => 'English',
			'es' => 'Spanish',
			'fr' => 'French',
			'it' => 'Italian',
			'nl' => 'Dutch',
			'pt-BR' => 'Brazilian Portuguese',
			'sv' => 'Swedish',
			'th' => 'Thai',
		],
	],

	'validation' => [
		'accepted' => 'The :attribute must be accepted.',
		'active_url' => 'The :attribute is not a valid URL.',
		'after' => 'The :attribute must be a date after :date.',
		'alpha' => 'The :attribute may only contain letters.',
		'alpha_dash' => 'The :attribute may only contain letters, numbers, and dashes.',
		'alpha_num' => 'The :attribute may only contain letters and numbers.',
		'array' => 'The :attribute must be an array.',
		'before' => 'The :attribute must be a date before :date.',
		'between' => [
			'numeric' => 'The :attribute must be between :min and :max.',
			'file' => 'The :attribute must be between :min and :max kilobytes.',
			'string' => 'The :attribute must be between :min and :max characters.',
			'array' => 'The :attribute must have between :min and :max items.',
		],
		'boolean' => 'The :attribute field must be true or false.',
		'confirmed' => 'The :attribute confirmation does not match.',
		'date' => 'The :attribute is not a valid date.',
		'date_format' => 'The :attribute does not match the format :format.',
		'different' => 'The :attribute and :other must be different.',
		'digits' => 'The :attribute must be :digits digits.',
		'digits_between' => 'The :attribute must be between :min and :max digits.',
		'dimensions' => 'The :attribute has invalid image dimensions.',
		'distinct' => 'The :attribute field has a duplicate value.',
		'email' => 'The :attribute must be a valid email address.',
		'exists' => 'The selected :attribute is invalid.',
		'file' => 'The :attribute must be a file.',
		'filled' => 'The :attribute field is required.',
		'image' => 'The :attribute must be an image.',
		'in' => 'The selected :attribute is invalid.',
		'in_array' => 'The :attribute field does not exist in :other.',
		'integer' => 'The :attribute must be an integer.',
		'ip' => 'The :attribute must be a valid IP address.',
		'json' => 'The :attribute must be a valid JSON string.',
		'max' => [
			'numeric' => 'The :attribute may not be greater than :max.',
			'file' => 'The :attribute may not be greater than :max kilobytes.',
			'string' => 'The :attribute may not be greater than :max characters.',
			'array' => 'The :attribute may not have more than :max items.',
		],
		'mimes' => 'The :attribute must be a file of type: :values.',
		'min' => [
			'numeric' => 'The :attribute must be at least :min.',
			'file' => 'The :attribute must be at least :min kilobytes.',
			'string' => 'The :attribute must be at least :min characters.',
			'array' => 'The :attribute must have at least :min items.',
		],
		'not_in' => 'The selected :attribute is invalid.',
		'numeric' => 'The :attribute must be a number.',
		'present' => 'The :attribute field must be present.',
		'regex' => 'The :attribute format is invalid.',
		'required' => 'The :attribute field is required.',
		'required_if' => 'The :attribute field is required when :other is :value.',
		'required_unless' => 'The :attribute field is required unless :other is in :values.',
		'required_with' => 'The :attribute field is required when :values is present.',
		'required_with_all' => 'The :attribute field is required when :values is present.',
		'required_without' => 'The :attribute field is required when :values is not present.',
		'required_without_all' => 'The :attribute field is required when none of :values are present.',
		'same' => 'The :attribute and :other must match.',
		'size' => [
			'numeric' => 'The :attribute must be :size.',
			'file' => 'The :attribute must be :size kilobytes.',
			'string' => 'The :attribute must be :size characters.',
			'array' => 'The :attribute must contain :size items.',
		],
		'string' => 'The :attribute must be a string.',
		'timezone' => 'The :attribute must be a valid zone.',
		'unique' => 'The :attribute has already been taken.',
		'url' => 'The :attribute format is invalid.',
	],

	'status' => [
		'online' => 'Online',
		'offline' => 'Offline',
		'inherited' => 'Inherited',
		'enabled' => 'Enabled',
		'disabled' => 'Disabled',
	],

	'unit' => [
		'minutes' => ' minutes',
	],

	'search' => [
		'search' => 'Search',
		'placeholder' => 'Search...',
		'empty' => 'Please enter a search term.',
		'incomplete' => 'You must write your own search logic for this system.',
		'title' => 'Search Results',
		'results' => 'Search Results for ":query"',
		'result_count' => '{0} There are no results returned for the query|{1} There is :number result returned for the query|[2,*] There are :number results returned for the query',
		'result_in' => 'Searching in :target',
	],

	'modal' => [
		'delete' => 'Delete',
		'are_you_sure' => 'Are you sure?',
		'continue' => 'Continue',
		'cancel' => 'Cancel',
	],

	'greeting' => [
		'welcome' => 'Welcome',
	],

	'general' => [
		'all' => 'All',
		'yes' => 'Yes',
		'no' => 'No',
		'cancel' => 'Cancel',
		'custom' => 'Custom',
		'action' => 'Action',
		'actions' => 'Actions',
		'active' => 'Active',
		'confirmed' => 'Confirmed',
		'name' => 'Name',
		'sort' => 'Sort',
		'close' => 'Close',
		'people' => '{0} People|{1} Person|[2,*] People',
		'soon' => 'Coming Soon',
		'slug' => 'Slug',

		'buttons' => [
			'save' => 'Save',
			'save_changes' => 'Save Changes',
			'update' => 'Update',
			'view' => 'View',
			'refresh' => 'Refresh',
			'print' => 'Print',
			'dismiss' => 'Dismiss',
			'connect' => 'Connect',
			'disconnect' => 'Disconnect',
			'next_step' => 'Proceed to Next Step',
		],

		'hide' => 'Hide',
		'inactive' => 'Inactive',
		'none' => 'None',
		'show' => 'Show',
		'select' => 'Select',
		'filter' => 'Filter',
		'toggle_navigation' => 'Toggle Navigation',
		'toggle_search' => 'Toggle Search',
		'toggle_fullscreen' => 'Toggle Fullscreen',
		'toggle_menubar' => 'Toggle Menubar',
		'back_to_top' => 'Back to Top',

		'crud' => [
			'create' => 'Create',
			'delete' => 'Delete',
			'deactivate' => 'Deactivate',
			'activate' => 'Activate',
			'edit' => 'Edit',
			'update' => 'Update',
			'view' => 'View',
			'refresh' => 'Refresh',
			'remove' => 'Remove',
			'parent' => 'Parent Record',
			'parent_select' => 'Select Parent Record (if applicable)',
		],
	],

	'pagination' => [
		'previous' => '&laquo; Previous',
		'previous_text' => 'Previous',
		'next' => 'Next &raquo;',
		'next_text' => 'Next',
	],

	'tabs' => [
		'home' => 'Home',
		'home_return' => 'Return to Homepage',
		'overview' => 'Overview',
		'history' => 'History',
		'dashboard' => 'Dashboard',
		'general' => 'General',
		'system' => 'System',
		'settings' => 'Settings',
		'teams' => 'Projects',
		'admin' => 'Admin',
	],

	'history' => [
		'none' => 'There is no recent history.',
		'none_for_type' => 'There is no history for this type.',
		'none_for_entity' => "There is no history for this :entity.",
		'recent_history' => 'Recent History',
	],

	'http' => [

		'bad_request' => 'Bad Request',

		'400' => [
			'title' => 'Bad Request',
			'description' => 'The server cannot or will not process the request due to something that is perceived to be a client error (e.g., malformed request syntax, invalid request message framing, or deceptive request routing).',
		],

		'403' => [
			'title' => 'Forbidden',
			'description' => 'The request was a valid request, but the server is refusing to respond to it.',
		],

		'404' => [
			'title' => 'Not Found',
			'description' => 'The requested resource could not be found but may be available again in the future.',
		],

		'408' => [
			'title' => 'Request Timeout',
			'description' => 'The server timed out waiting for the request. According to HTTP specifications: "The client did not produce a request within the time that the server was prepared to wait. The client MAY repeat the request without modifications at any later time."',
		],

		'418' => [
			'title' => 'I\'m a teapot',
			'description' => 'Hyper Text Coffee Pot Control Protocol',
		],

		'500' => [
			'title' => 'Internal Server Error',
			'description' => 'Looks like something went wrong... but we will fix it!',
		],

		'503' => [
			'title' => 'Service Unavailable',
			'description' => 'The server is currently unavailable (because it is overloaded or down for maintenance)',
		],

		'701' => [
			'title' => 'Data Not Found.',
			'description' => 'Data Not Found.',
		],
	],

	'log' => [
		'title' => 'Logs',
		'all' => 'All Logs',
		'type' => 'Logs By Type',
	],

	'legal' => [
		'all_rights_reserved' => 'All Rights Reserved.',
	],


];
