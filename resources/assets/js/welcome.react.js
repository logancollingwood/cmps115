var Welcome = React.createClass({
    render: function() {
        var message = 'LoLstats';
        return React.DOM.div({
                className: "container"
            },
            React.DOM.div({
                    className: "content"
                },
                React.DOM.div({
                    className: "title"
                }, message)
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