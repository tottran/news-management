import React, { Component } from "react";
import { Link } from "react-router-dom";
import Button from "react-bootstrap/Button";
import axios from "axios";
import Swal from "sweetalert2";

type Props = {
  obj: any;
};
type State = {};

export default class ProjectTableRow extends Component<Props, State> {
  constructor(props: Props) {
    super(props);
    this.deleteProject = this.deleteProject.bind(this);
  }

  deleteProject() {
    axios
      .delete(
        `${process.env.MIX_REACT_APP_DOMAIN}/api/projects/${this.props.obj.id}`
      )
      .then((res) => {
        Swal.fire("Hoàn thành!", `Project đã xoá thành công`, "success");
      })
      .catch((error) => {
        console.log(error);
      });
  }
  render() {
    return (
      <tr>
        <td>{this.props.obj.name}</td>
        <td>{this.props.obj.url}</td>
        <td>{this.props.obj.description}</td>
        <td>
          <Link className="edit-link" to={"/edit-project/" + this.props.obj.id}>
            <Button size="sm" variant="info">
              Edit
            </Button>
          </Link>
          <Button onClick={this.deleteProject} size="sm" variant="danger">
            Delete
          </Button>
        </td>
      </tr>
    );
  }
}
