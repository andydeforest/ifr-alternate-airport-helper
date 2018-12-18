import React, { Component } from 'react'
import axios from 'axios'
import AppLayout from './ui/AppLayout'
import Sidebar from './ui/Sidebar'
import Map from './Map'
import 'bootstrap/dist/css/bootstrap.min.css'

export default class App extends Component {

	constructor(props) {
		super(props);
		this.state = {
			airport: null,
			radius: null,
			non_precision_airports: [],
			precision_airports: [],
			loading: false
		}
	}

	update = data => {
		if(data.airport !== '') {
			axios.post('api/parse', data).then(response => {
				if(response.data.airport !== null) {
					this.setState({
						airport: response.data.airport, 
						radius: response.data.radius,
						non_precision_airports: response.data.non_precision_airports,
						precision_airports: response.data.precision_airports
					});
				}
			}).then(this.setState({ loading: false }));
		}
	}


	render() {
		return (
			<AppLayout>
				<div className="container-fluid">
					<div className="row">
						<Sidebar update={this.update} loading={this.props.loading} />
						<Map {...this.state} />
					</div>
				</div>
			</AppLayout>
		)
	}
}

