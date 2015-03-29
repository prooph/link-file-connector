Prooph\Link\FileConnector
=========================
File connector module for [prooph LINK](https://github.com/prooph/link)

# Import and Export

The file connector module provides a workflow message handler which is capable of reading a `Processing\Type\Type` from file or write it to a file. Out of the box the module supports the file types `CSV` and `JSON` but you can add other file type handlers by implementing the [FileTypeAdapter](https://github.com/prooph/link-file-connector/blob/master/src/Service/FileTypeAdapter.php) interface and adding the adapter via configuration to the list of supported file types. See the comments in the [module.config.php](https://github.com/prooph/link-file-connector/blob/master/config/module.config.php) for details.

# Configuration

The module adds a widget to the dashboard which provides access to a file connector configurator. With the help of the configurator you can set up different preconfigured connectors that can be used in workflow processes as source or target workflow message handlers depending on the scope you've defined the configurator.

- Import Scope = available as a source
- Export Scope = available as a target

# Support

- Ask any questions on [prooph-users](https://groups.google.com/forum/?hl=de#!forum/prooph) google group.
- File issues at [https://github.com/prooph/link-file-connector/issues](https://github.com/prooph/link-file-connector/issues).

# Contribution

You wanna help us? Great!
We appreciate any help, be it on implementation level, UI improvements, testing, donation or simply trying out the system and give us feedback.
Just leave us a note in our google group linked above and we can discuss further steps.

Thanks,
your prooph team 


