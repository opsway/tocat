<?php
return array(
    'router' => array(
        'routes' => array(
            'tocat-api.rest.project' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/v1/project[/:project_id]',
                    'defaults' => array(
                        'controller' => 'TocatApi\\V1\\Rest\\Project\\Controller',
                    ),
                ),
            ),
            'tocat-api.rest.ticket' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/v1/ticket[/:ticket_id]',
                    'defaults' => array(
                        'controller' => 'TocatApi\\V1\\Rest\\Ticket\\Controller',
                    ),
                ),
            ),
        ),
    ),
    'zf-versioning' => array(
        'uri' => array(
            0 => 'tocat-api.rest.project',
            1 => 'tocat-api.rest.ticket',
        ),
    ),
    'zf-rest' => array(
        'TocatApi\\V1\\Rest\\Project\\Controller' => array(
            'listener' => 'TocatApi\\V1\\Rest\\Project\\ProjectResource',
            'route_name' => 'tocat-api.rest.project',
            'route_identifier_name' => 'project_id',
            'collection_name' => 'project',
            'entity_http_methods' => array(
                0 => 'GET',
                1 => 'PATCH',
                2 => 'PUT',
                3 => 'DELETE',
            ),
            'collection_http_methods' => array(
                0 => 'GET',
                1 => 'POST',
            ),
            'collection_query_whitelist' => array(),
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => 'TocatApi\\V1\\Rest\\Project\\ProjectEntity',
            'collection_class' => 'TocatApi\\V1\\Rest\\Project\\ProjectCollection',
            'service_name' => 'project',
        ),
        'TocatApi\\V1\\Rest\\Ticket\\Controller' => array(
            'listener' => 'TocatApi\\V1\\Rest\\Ticket\\TicketResource',
            'route_name' => 'tocat-api.rest.ticket',
            'route_identifier_name' => 'ticket_id',
            'collection_name' => 'ticket',
            'entity_http_methods' => array(
                0 => 'GET',
                1 => 'PUT',
                2 => 'DELETE',
            ),
            'collection_http_methods' => array(
                0 => 'GET',
                1 => 'POST',
            ),
            'collection_query_whitelist' => array(),
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => 'TocatApi\\V1\\Rest\\Ticket\\TicketEntity',
            'collection_class' => 'TocatApi\\V1\\Rest\\Ticket\\TicketCollection',
            'service_name' => 'ticket',
        ),
    ),
    'zf-content-negotiation' => array(
        'controllers' => array(
            'TocatApi\\V1\\Rest\\Project\\Controller' => 'Json',
            'TocatApi\\V1\\Rest\\Ticket\\Controller' => 'Json',
        ),
        'accept_whitelist' => array(
            'TocatApi\\V1\\Rest\\Project\\Controller' => array(
                0 => 'application/vnd.tocat-api.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ),
            'TocatApi\\V1\\Rest\\Ticket\\Controller' => array(
                0 => 'application/vnd.tocat-api.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ),
        ),
        'content_type_whitelist' => array(
            'TocatApi\\V1\\Rest\\Project\\Controller' => array(
                0 => 'application/vnd.tocat-api.v1+json',
                1 => 'application/json',
            ),
            'TocatApi\\V1\\Rest\\Ticket\\Controller' => array(
                0 => 'application/vnd.tocat-api.v1+json',
                1 => 'application/json',
            ),
        ),
    ),
    'zf-hal' => array(
        'metadata_map' => array(
            'TocatApi\\V1\\Rest\\Project\\ProjectEntity' => array(
                'entity_identifier_name' => 'project_id',
                'route_name' => 'tocat-api.rest.project',
                'route_identifier_name' => 'project_id',
                'hydrator' => 'Zend\\Stdlib\\Hydrator\\ArraySerializable',
            ),
            'TocatApi\\V1\\Rest\\Project\\ProjectCollection' => array(
                'entity_identifier_name' => 'project_id',
                'route_name' => 'tocat-api.rest.project',
                'route_identifier_name' => 'project_id',
                'is_collection' => true,
            ),
            'TocatApi\\V1\\Rest\\Ticket\\TicketEntity' => array(
                'entity_identifier_name' => 'ticket_id',
                'route_name' => 'tocat-api.rest.ticket',
                'route_identifier_name' => 'ticket_id',
                'hydrator' => 'Zend\\Stdlib\\Hydrator\\ArraySerializable',
            ),
            'TocatApi\\V1\\Rest\\Ticket\\TicketCollection' => array(
                'entity_identifier_name' => 'ticket_id',
                'route_name' => 'tocat-api.rest.ticket',
                'route_identifier_name' => 'ticket_id',
                'is_collection' => true,
            ),
        ),
    ),
    'zf-apigility' => array(
        'db-connected' => array(
            'TocatApi\\V1\\Rest\\Project\\ProjectResource' => array(
                'adapter_name' => 'dbBase',
                'table_name' => 'project',
                'hydrator_name' => 'Zend\\Stdlib\\Hydrator\\ArraySerializable',
                'controller_service_name' => 'TocatApi\\V1\\Rest\\Project\\Controller',
                'entity_identifier_name' => 'project_id',
                'table_service' => 'TocatApi\\V1\\Rest\\Project\\ProjectResource\\Table',
            ),
        ),
    ),
    'zf-content-validation' => array(
        'TocatApi\\V1\\Rest\\Project\\Controller' => array(
            'input_filter' => 'TocatApi\\V1\\Rest\\Project\\Validator',
        ),
        'TocatApi\\V1\\Rest\\Ticket\\Controller' => array(
            'input_filter' => 'TocatApi\\V1\\Rest\\Ticket\\Validator',
        ),
    ),
    'input_filter_specs' => array(
        'TocatApi\\V1\\Rest\\Project\\Validator' => array(
            0 => array(
                'name' => 'project_id',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
                'description' => 'Project External Identificator, Integer',
                'error_message' => 'Only alphabetical',
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
            1 => array(
                'name' => 'budget',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
                'description' => 'Total cost for project',
                'allow_empty' => true,
                'continue_if_empty' => true,
                'error_message' => 'Should be positive float number',
            ),
            2 => array(
                'name' => 'uid',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
                'continue_if_empty' => true,
                'allow_empty' => true,
                'description' => 'Uniq autoincrement ID (internal)',
            ),
        ),
        'TocatApi\\V1\\Rest\\Ticket\\Validator' => array(
            0 => array(
                'name' => 'uid',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
            ),
            1 => array(
                'name' => 'ticket_id',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
            ),
            2 => array(
                'name' => 'budget',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
            ),
        ),
    ),
    'service_manager' => array(
        'factories' => array(
            'TocatApi\\V1\\Rest\\Ticket\\TicketResource' => 'TocatApi\\V1\\Rest\\Ticket\\TicketResourceFactory',
        ),
    ),
);
