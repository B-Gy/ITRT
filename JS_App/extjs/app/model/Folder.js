Ext.define('ITRT.model.Folder', {
  extend: 'Ext.data.Model',
  idProperty: 'id',
  fields:[
    {name: 'id', type: 'int'},
    {name: 'name', type: 'string'}
  ],
  proxy: {
    type: 'rest',
    url: '/folders'
  }
});
