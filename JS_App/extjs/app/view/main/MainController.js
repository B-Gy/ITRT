/**
 * This class is the controller for the main view for the application. It is specified as
 * the "controller" of the Main view class.
 *
 * TODO - Replace this content of this view to suite the needs of your application.
 */
Ext.define('ITRT.view.main.MainController', {
    extend: 'Ext.app.ViewController',

    alias: 'controller.main',

    folderSelected: function(treePanel, record, index, options) {
      Ext.Msg.alert('Folder selected', Ext.String.format('With name: {0} and id: {1}', record.get('name'), record.get('id')));
    }
});
