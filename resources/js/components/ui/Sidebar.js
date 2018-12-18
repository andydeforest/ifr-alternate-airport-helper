import React, { Component } from 'react'
import { FaGithub } from 'react-icons/fa';
import ClipLoader from 'react-spinners/ClipLoader'

export default class Sidebar extends Component {

	constructor(props) {
		super(props);
		this.state = {
			airport: '',
			speed: '',
			arrival: '',
			loading: false,
		}
	}

	componentWillMount() {
		this.timer = null;
	}

	handleInput = (e, key) => {
		clearTimeout(this.timer);
		this.setState({ [key]: e.target.value, loading: true });
        this.timer = setTimeout(() => {
			this.setState({ loading: false });
			this.props.update(this.state)
		}, 1000);

	}

	render() {
		return (
			<nav className="col-md-2 d-none d-md-block bg-dark text-light sidebar" style={{ height: '100vh' }}>
				<div className="sidebar-header pt-3">
					<h3>IFR Alternate Helper</h3>
				</div>
				<div className="sidebar-sticky">
					<div className="row pt-5">
						<div className="col">
							<label>Arrival Airport</label>
							<input className="form-control" placeholder="KDFW" value={this.state.airport} onChange={e => this.handleInput(e, 'airport')} autoFocus />
						</div>
					</div>
					<div className="row pt-3">
						<div className="col">
							<label>Cruise Speed (kts)</label>
							<input className="form-control" placeholder="120" value={this.state.speed} onChange={e => this.handleInput(e, 'speed')} />
						</div>
					</div>
					<div className="row pt-3">
						<div className="col text-center">
							{(this.state.loading || this.props.loading) && 
								<ClipLoader
									sizeUnit={"px"}
									size={45}
									color={'#fff'}
									loading={this.state.loading}
								/>
							}
						</div>
					</div>
					<div style={{ position: 'absolute', bottom: '10px' }}>
						<div className="row align-items-end" >
							<div className="col text-center">
								<p>Please verify information before flying :)</p>
							</div>
						</div>
						<div className="row">
							<div className="col text-center">
								<FaGithub size={32} />
							</div>
						</div>
					</div>
				</div>
			</nav>
		)
	}
}
