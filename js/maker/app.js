define([
       "jquery" , "underscore" , "backbone",
       "collections/snippets" , "collections/my-form-snippets",
       "views/tab" , "views/my-form",
       "text!data/text.json", "text!data/choice.json","text!templates/app/help.html",
], function(
  $, _, Backbone,
  SnippetsCollection, MyFormSnippetsCollection,
  TabView,
  MyFormView,
  textJSON, choiceJSON, helpTab
){
  return {
    initialize: function(){

      //Bootstrap tabs from json.
      new TabView({
        title: "Text",
        collection: new SnippetsCollection(JSON.parse(textJSON))
      });
      new TabView({
        title: "Choices",
        collection: new SnippetsCollection(JSON.parse(choiceJSON))
      });
      new TabView({
        title: "Help",
        content: helpTab
      });

      //Make the first tab active!
      $("#components .tab-pane").first().addClass("active");
      $("#formtabs li").first().addClass("active");
      // Bootstrap "My Form" with 'Form Name' snippet.
      new MyFormView({
        title: "Original",
        collection: new MyFormSnippetsCollection([
          { "title" : "Form Name",
            "fields": {
              "name": {
                "label" : "Form Name",
                "type"  : "input",
                "value" : "Form Name"
              }
            }
          }
        ])
      });
    }
  };
});
