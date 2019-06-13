import React, { Component } from 'react';
import Result from "./Result";

export default class ResultsSection extends Component {
    render() {
        let {results} = this.props;

        return (
            <div className={'justify-content-center'}>
                {
                    results.map(result => {
                        console.log(result);
                        return (
                            <Result key={result.id} result={result} />
                        )
                    })
                }
            </div>
        );

    }
}