import React, { Component } from 'react'
import { Map as LMap, TileLayer, Circle } from 'react-leaflet'
import 'leaflet/dist/leaflet.css'
import AirportMarker from './AirportMarker'

export default class Map extends Component {

	constructor(props) {
		super(props);
		this.state = {
			bounds: null
		}
	}

	render() {

		let map;
		let radius = null;

		if(!this.props.airport) {
			map = (
				<LMap ref="map" onMoveEnd={() => this.refs.radius_circle ? this.setState({ bounds: this.refs.radius_circle.leafletElement.getBounds() }) : null} style={{ width: '100%', height: '100vh' }} center={[36.505, -100.09]} zoom={5}>
					<TileLayer
						url="https://{s}.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}{r}.png"
						attribution="&copy; <a href=&quot;http://www.openstreetmap.org/copyright&quot; target=&quot;_blank&quot;>OpenStreetMap</a> &copy; <a href=&quot;https://carto.com/attributions&quot; target=&quot;_blank&quot;>CARTO</a>"
					/>
				</LMap>
			);
		} else {
			if(this.props.radius > 0) {
				radius = (
					<Circle ref="radius_circle" radius={this.props.radius} center={[this.props.airport.latitude, this.props.airport.longitude]} fillColor="#52bf90" fillOpacity="0.3" stroke={true} color="#14504f" weight={1} onadd={o => this.setState({ bounds: o.target.getBounds() })}  />
				);
			}

			map = (
				<LMap ref="map" bounds={this.state.bounds} style={{ width: '100%', height: '100vh' }} center={[Number.parseFloat(this.props.airport.latitude), Number.parseFloat(this.props.airport.longitude)]} zoom={5}>
					<TileLayer
						url="https://{s}.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}{r}.png"
						attribution="&copy; <a href=&quot;http://www.openstreetmap.org/copyright&quot; target=&quot;_blank&quot;>OpenStreetMap</a> &copy; <a href=&quot;https://carto.com/attributions&quot; target=&quot;_blank&quot;>CARTO</a>"
					/>
					{radius}
					<AirportMarker radius={6} airport={this.props.airport} fillColor="#00b5ad" fillOpacity="1" stroke={true} color="#14504f" weight={1} />
					{this.props.non_precision_airports.map((airport, i) => {
						return <AirportMarker key={i} radius={4} airport={airport} fillColor="#ff7a5a" fillOpacity="1" stroke={true} color="#14504f" weight={1} non_prec={true} />
					})}
					{this.props.precision_airports.map((airport, i) => {
						return <AirportMarker key={i} radius={4} airport={airport} fillColor="#454b97" fillOpacity="1" stroke={true} color="#14504f" weight={1} prec={true} />
					})}
				</LMap>
			);
		}

		return (
			<div className="col" style={{ height: '100vh', padding: '0' }}>
				<div className="leaflet-container">
					{map}
				</div>
			</div>
		)
	}
}
