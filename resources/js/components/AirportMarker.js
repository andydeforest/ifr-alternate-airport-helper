import React, { Component } from 'react'
import { CircleMarker, Popup } from 'react-leaflet'

export default class AirportMarker extends Component {
	render() {
		return (
			<CircleMarker center={[this.props.airport.latitude, this.props.airport.longitude]} {...this.props}>
				<Popup style={{ textAlign: 'center' }}>
					<table className="table table-bordered">
						<thead>
							<tr>
								<th colSpan="2">{this.props.airport.name} ({this.props.airport.identifier})</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td><strong>Distance:</strong></td>
								<td>{Number.parseFloat(this.props.airport.distance).toFixed(1)} nm</td>
							</tr>
							<tr>
								<td><strong>Coords:</strong></td>
								<td>{Number.parseFloat(this.props.airport.latitude).toFixed(5)} / {Number.parseFloat(this.props.airport.longitude).toFixed(5)}</td>
							</tr>
							{this.props.non_prec &&
								<tr>
									<td colSpan="2" className="text-center">Non-precision approach available</td>
								</tr>
							}
							{this.props.prec &&
								<tr>
									<td colSpan="2" className="text-center">Precision approach available</td>
								</tr>
							}
						</tbody>
					</table>
				</Popup>
			</CircleMarker>
		)
	}
}
