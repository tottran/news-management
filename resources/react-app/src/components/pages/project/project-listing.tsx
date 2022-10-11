import React, { Component } from "react";
import axios from "axios";
import Table from "react-bootstrap/Table";
import ProjectTableRow from "./projectTableRow";

type Props = {};
type State = {
  projects: any;
};

export default class ProjectList extends Component<Props, State> {
  constructor(props: Props) {
    super(props);
    this.state = {
      projects: [],
    };
  }

  componentDidMount() {
    axios
      .get(`${process.env.MIX_REACT_APP_DOMAIN}/api/projects/`)
      .then((res) => {
        this.setState({
          projects: res.data,
        });
      })
      .catch((error) => {
        console.log(error);
      });
  }

  DataTable() {
    return this.state.projects.map((res: any, i: any) => {
      return <ProjectTableRow obj={res} key={i} />;
    });
  }

  render() {
    return (
      <div className="table-wrapper">
        <Table striped bordered hover>
          <thead>
            <tr>
              <th>Name</th>
              <th>Url</th>
              <th>Description</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>{this.DataTable()}</tbody>
        </Table>
      </div>
    );
  }
}
