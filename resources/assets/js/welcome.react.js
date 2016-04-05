var Welcome = React.createClass({
    render: function() {
      return React.DOM.div({className:"container"},
      	React.DOM.div({className:"content"},
      		React.DOM.p({className: "title"}, "Hello World")
      		)
      	);
    }
  });

// Call React.createFactory instead of directly call ExampleApplication({...}) in React.render
var WelcomeFactory = React.createFactory(Welcome);

  
  
ReactDOM.render(
  WelcomeFactory(),
  document.getElementById('welcome')
);
  