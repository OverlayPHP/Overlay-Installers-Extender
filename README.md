# Overlay PHP Installers Extender

Firstly, thanks to the folk who created this project to enable non-standard install
types through composer - found at [`oomphinc/composer-installers-extender`][]

The `Overlay-Installers-Extender` is a plugin for [Composer][] that allows
Overlay packages, including Modules and Themes to be installed to a directory
other than the default `vendor` directory within a project on a package-by-package
basis. This plugin extends the [`composer/installers`][] plugin to allow Overlay package
types to be handled.

This plugin allows additional package types used by Overlay to be handled by the
[`composer/installers`][] plugin, benefiting from their explicit install path mapping
and token replacement of package properties.

## How to Install

Add `Overlay/Overlay-Installers-Extender` as a dependency of your project:

```bash
$ composer require Overlay/Overlay-Installers-Extender
```

## How to Use

The [`composer/installers`][] plugin is a dependency of this plugin and will be
automatically required as well if not already required.

If you create a custom component for Overlay, please use one of the correct type in the
`composer.json` file:

```json
"type": "overlay-module"
"type": "overlay-theme"
"type": "overlay-command"
"type": "overlay-library"
"type": "overlay-helper"
```

To support additional package types (which will not be supported natively by Overlay,
add an array of these types in the `extra` property in your `composer.json`:

```json
{
    "extra": {
        "installer-types": ["library"]
    }
}
```

Then, you can add mappings for packages of these types in the same way that you
would add package types that are supported by [`composer/installers`][]:

```json
{
    "extra": {
        "installer-types": ["library"],
        "installer-paths": {
            "special/package/": ["my/package"],
            "path/to/libraries/{$name}/": ["type:library"]
        }
    }
}
```

By default, packages that do not specify a `type` will be considered of the type
`library`. Adding support for this type `library` allows any of these packages to be
placed in a different install path (a path other than `\vendor`)

If a type has been added to `installer-types`, the plugin will attempt to find
an explicit installer path in the mapping. If there is no match either by name
or by type, the default installer path for all packages will be used instead.

Please see the README for [`composer/installers`][] to see the supported syntax
for package and type matching as well as the supported replacement tokens in
the path (e.g. `{$name}`).

## License

[MIT License][]

[Composer]: https://getcomposer.org
[`composer/installers`]: https://github.com/composer/installers
[`oomphinc/composer-installers-extender`]: https://github.com/oomphinc/composer-installers-extender
[MIT License]: LICENSE
