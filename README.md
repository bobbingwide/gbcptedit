# gbcptedit
Gutenberg Custom Post Type Edit

A plugin to enable editing of the Custom Post Types created by the Gutenberg plugin, which are now part of WordPress 5.9

The Gutenberg block editor created a number of new Custom Post Types:

CPT | Description
--- | -------
wp_block | Reusable blocks
wp_template | Templates
wp_template_part | Template parts
wp_navigation | Navigation menus

These post types are not normally available for public inspection and/or editing.

Developers and advanced users of Gutenberg blocks and Full Site Editing themes may have tools that can be used to manually alter the
post type definitions to enable viewing of the post contents. I use my oik-types plugin to do this.

For each development environment it's a manual process to define the CPT overrides. 
I'm currently debugging what should be a simple problem associated with the new CPT `wp_navigation`. 
It would be a lot easier if I could simply install and activate a plugin that automates the manual process,
plus the extra logic that I've added to my Fizzie FSE theme.


### Requirement

Ability to easily turn on an off editing of Gutenberg related Custom Post Types.

I want to find out whether or not a navigation menu imported into WordPress from a template part
has the same blocks as it started with.
Specifically. What happens to this block, which was generated using Gutenberg 12.3.0, when using WordPress 5.9 with Gutenberg deactivated.

```
<!-- wp:home-link {"label":"Home"} /-->
```

### Proposed solution
- [ ] Develop a simple plugin called gbcptedit - standing for GutenBerg Custom Post Type EDIT
- [ ] Implement hard coded CPT overrides that will once again open up the Admin interface to list and edit these CPTs
- [ ] Add extra logic required to re-enable editing of the `wp_navigation` CPT. 

