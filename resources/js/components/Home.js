import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import {apiPrefix} from '../config';
import ResultsSeaction from "./ResultsSection";
import { library } from '@fortawesome/fontawesome-svg-core';
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
import { faSpinner, faInfinity, faYinYang, faFan } from '@fortawesome/free-solid-svg-icons';

library.add(faSpinner);
library.add(faInfinity);
library.add(faYinYang);
library.add(faFan);

export default class Home extends Component {

    constructor(props) {
        super(props);
        this.state = {
            houses: [],
            loading: false
        };
    }



    getAllHouses() {
        fetch(apiPrefix+'search/houses/all', { method: 'GET' })
            .then(response => {
                return response.json();
            })
            .then(houses => {
                console.log(houses);
                this.setState({
                    houses
                });
            })
            .catch(err => console.log(err));
    }

    onSubmit(e) {
        e.preventDefault();
        this.setState({loading: true});
        let node = this.refs;
        let name = node.name.value;
        let bedrooms = node.bedrooms.value;
        let bathrooms = node.bathrooms.value;
        let storeys = node.storeys.value;
        let garages = node.garages.value;
        let priceFrom = node.from.value;
        let priceUpto = node.upto.value;

        let filterParams = {
            name, bedrooms, bathrooms, storeys, garages, priceFrom, priceUpto
        };
        let queryString = '';
        for(let params in filterParams) {
            if (filterParams[params] !== "") {
                queryString += `${params}=${filterParams[params]}&`
            }
        }

        fetch(apiPrefix+'search/houses?'+queryString)
            .then(response => {
                return response.json();
            })
            .then(houses => {
                setTimeout(() => {
                    this.setState({
                        loading: false,
                        houses
                    });
                }, 1000);

            })
            .catch(err => console.log(err));
    }

    render() {
        let {houses, loading} = this.state;

        return (
            <div className="container">
                <div className="text-center">
                    <h1>House search</h1>
                </div>
                <div className="row justify-content-center">
                    <form method={'get'} onSubmit={this.onSubmit.bind(this)}>
                        <div className="form-group">
                            <label htmlFor="name">Name of the house</label>
                            <input type="text" ref={'name'} className="form-control" id="name" placeholder="Enter name of the house" />
                        </div>
                        <div className="form-group">
                            <label htmlFor="bedrooms">Bedrooms</label>
                            <input type="number" ref={'bedrooms'} className="form-control"
                                   placeholder="Bedrooms" />
                        </div>
                        <div className="form-group">
                            <label htmlFor="bathrooms">Bathrooms</label>
                            <input type="number" ref={'bathrooms'} className="form-control"
                                   placeholder="Bathrooms" />
                        </div>
                        <div className="form-group">
                            <label htmlFor="storeys">Storeys</label>
                            <input type="number" ref={'storeys'} className="form-control"
                                   placeholder="Storeys" />
                        </div>
                        <div className="form-group">
                            <label htmlFor="garages">Garages</label>
                            <input type="number" ref={'garages'} className="form-control"
                                   placeholder="Garages" />
                        </div>
                        <div className="form-group">
                            <label htmlFor="price">Price</label>
                            <div className="row">
                                <div className="col">
                                    <input type="number" ref={'from'} className="form-control"
                                           placeholder="From" step={'0.1'} />
                                </div>
                                <span>&#95;</span>
                                <div className="col">
                                    <input type="number" ref={'upto'} className="form-control"
                                           placeholder="Up to" step={'0.1'}/>
                                </div>
                            </div>
                        </div>
                        <button type="submit" className="btn btn-primary">Submit</button>
                    </form>
                </div>
                { loading ?
                    <div className={'text-center'}>
                        <FontAwesomeIcon size='7x' color='#3490dc' className='fa-spin' icon="fan" style={{color: '#3490dc'}} />
                    </div>
                    :
                    <ResultsSeaction results={houses} />
                }
            </div>
        );
    }
}
if (document.getElementById('root')) {
    ReactDOM.render(<Home />, document.getElementById('root'));
}
