import React, { Component } from 'react';

export default class Result extends Component {
    render() {
        let {name, bathrooms, bedrooms, storeys, garages, price, message } = this.props.result;

        return (
            <div className={'text-center'}>
                {
                    message === undefined ?
                        <div>
                            <h4>{name}</h4>
                            <p><strong>Bathrooms:</strong> {bathrooms}</p>
                            <p><strong>Bedrooms:</strong> {bedrooms}</p>
                            <p><strong>Storeys:</strong> {storeys}</p>
                            <p><strong>Garages:</strong> {garages}</p>
                            <p><strong>Price:</strong> {price}</p>
                        </div>
                        : <p>{message}</p>
                }
            </div>
        )
    }
}