/**
 * Nova Theme Custom Blocks - Editor Script (Vanilla JS)
 *
 * Registers the editor-side functionality for custom blocks
 * using standard WordPress JavaScript APIs without a build step.
 *
 * @package Nova
 * @since   1.0.0
 * @author  Movve - https://movve.nl
 *
 * @requires {object} wp - The global WordPress object.
 *
 * @link https://developer.wordpress.org/block-editor/reference-guides/packages/packages-blocks/
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
    const blockIcon = 'format-image';

    // --- Register Footer Logo Block ---
    registerBlockType('nova/footer-logo', {
        title: __('Footer Logo', 'nova'),
        description: __('Displays the site logo in the footer.', 'nova'),
        category: 'nova',
        icon: blockIcon,
        keywords: [__('logo', 'nova'), __('footer', 'nova'), __('brand', 'nova')],
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
                    block: 'nova/footer-logo',
                    attributes: props.attributes,
                    EmptyResponsePlaceholder: function () {
                        return el('p', {style: {fontStyle: 'italic', color: '#777'}},
                            __('Footer Logo preview. Set the logo in Appearance > Customize > Site Identity.', 'nova')
                        );
                    }
                })
            );
        },

        /**
         * Save function: Returns null because rendering is handled server-side.
         * The block's representation in post_content will be just the comment:
         * <!-- wp:nova/footer-logo /-->
         */
        save: function () {
            return null;
        },
    });

}(window.wp)); // Pass the global wp object
