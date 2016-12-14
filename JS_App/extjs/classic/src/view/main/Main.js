/**
 * This class is the main view for the application. It is specified in app.js as the
 * "mainView" property. That setting automatically applies the "viewport"
 * plugin causing this view to become the body element (i.e., the viewport).
 *
 * TODO - Replace this content of this view to suite the needs of your application.
 */
Ext.define('ITRT.view.main.Main', {
    extend: 'Ext.Container',
    xtype: 'app-main',

    requires: [
      'Ext.plugin.Viewport',
      'Ext.window.MessageBox',

      'ITRT.view.main.MainController',
      'ITRT.view.main.MainModel',

      'ITRT.model.Folder'
    ],

    controller: 'main',
    viewModel: 'main',
    
    layout: 'border',

    items: [{
      region: 'west',
      width: 250,
      margin: '0 10 0 0',

      xtype: 'treepanel',
      displayField: 'name',
      rootVisible: false,
      bind: {
        title: '{name}',
        store: '{folders}'
      },
      listeners: {
        select: 'folderSelected'
      }
    },{
      region: 'center',

      xtype: 'panel',
      bind: {
        html: '{loremIpsum}',
        title: '{name}'
      }
    }]
});
