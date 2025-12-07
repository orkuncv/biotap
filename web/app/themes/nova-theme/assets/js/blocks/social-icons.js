/**
 * Nova Theme Custom Blocks - Social Icons Editor Script
 *
 * Registers the editor-side functionality for the social icons block
 * using standard WordPress JavaScript APIs without a build step.
 *
 * @package Nova
 * @since   1.0.0
 * @author  Movve - https://movve.nl
 *
 * @requires {object} wp - The global WordPress object.
 */
(function (wp) {
    'use strict';

    // Check if necessary WP packages are available
    if (!wp || !wp.blocks || !wp.element || !wp.i18n || !wp.serverSideRender || !wp.blockEditor) {
        console.error('Nova Blocks Error: Required WordPress script dependencies not loaded.');
        return;
    }

    // Destructure needed components for convenience
    const registerBlockType = wp.blocks.registerBlockType;
    const el = wp.element.createElement;
    const __ = wp.i18n.__;
    const ServerSideRender = wp.serverSideRender;
    const useBlockProps = wp.blockEditor.useBlockProps;

    // --- Register Social Links Block ---
    registerBlockType('nova/social-links', {
        title: __('Social Media Links', 'nova'),
        description: __('Displays the social media links defined in theme settings.', 'nova'),
        category: 'nova',
        keywords: [__('social', 'nova'), __('links', 'nova'), __('icons', 'nova'), __('media', 'nova'), __('follow', 'nova')],
        attributes: {},

        /**
         * Edit function: Renders the block preview in the editor.
         * Uses ServerSideRender to fetch the preview from the PHP callback.
         */
        edit: function (props) {
            const blockProps = useBlockProps();

            return el(
                'div',
                blockProps,
                el(ServerSideRender, {
                    block: 'nova/social-links',
                    attributes: props.attributes,
                    EmptyResponsePlaceholder: function () {
                        return el('p', { style: { fontStyle: 'italic', color: '#777' } },
                            __('Social Media Links preview. Configure links in Theme Settings.', 'nova')
                        );
                    }
                })
            );
        },

        /**
         * Save function: Returns null because rendering is handled server-side.
         * The block's representation in post_content will be just the comment:
         * <!-- wp:nova/social-links /-->
         */
        save: function () {
            return null;
        },
    });

}(window.wp)); // Pass the global wp object
