var Welcome = React.createClass({
    render: function() {
        return (
	        	<div className="content">
	        		<div className="title">
	        			{this.props.message}
	        		</div>
	        		<SearchForm region="na"/>
	        	</div>
        	);
    }
});

var SearchForm = React.createClass({
	componentDidMount: function() {

      $( this.refs.toggleInput.getDOMNode() ).bootstrapToggle();

    }, 
	render: function() {
		return (
				<div className="input-group input-group-lg">
				  	<div className="input-group-btn"> 
					  	<button type="button" className="btn btn-default">Go</button> 
					  	<button type="button" className="btn btn-default dropdown-toggle" 
					  		ref="toggleInput" data-toggle="dropdown" data-on="On" data-off="Off" 
					  		aria-haspopup="true" aria-expanded="false"> 
							  	<span className="caret"></span> 
							  	<span className="sr-only">Toggle Dropdown</span> 
					  	</button> 
					  	<ul className="dropdown-menu">
					  		<li><a href="#">Action</a></li> 
					  		<li><a href="#">Another action</a></li> 
					  		<li><a href="#">Something else here</a></li> 
					  		<li role="separator" class="divider"></li> 
					  		<li><a href="#">Separated link</a></li> 
					  	</ul> 
				  	</div>
				  	<input type="text" className="form-control" aria-label="..." />
				</div>
			   );
	}
});

ReactDOM.render(
	<Welcome message="LoLstats" />,
    document.getElementById('welcome')
);