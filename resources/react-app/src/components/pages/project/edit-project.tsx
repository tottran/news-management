import React, { Component } from "react";
import Form from "react-bootstrap/Form";
import Button from "react-bootstrap/Button";
import axios from "axios";
import history from "../../../history";
import { RouteProps, useParams } from "react-router-dom";
import Swal from "sweetalert2";

type Props = {};
type State = {
  name: string;
  description: string;
  url: string;
};
export default class EditProject extends Component<Props & RouteProps, State> {
  constructor(props: Props) {
    super(props);
    this.onChangeProjectName = this.onChangeProjectName.bind(this);
    this.onChangeProjectUrl = this.onChangeProjectUrl.bind(this);
    this.onChangeProjectDescription =
      this.onChangeProjectDescription.bind(this);
    this.onSubmit = this.onSubmit.bind(this);

    // State
    this.state = {
      name: "",
      url: "",
      description: "",
    };
  }

  componentDidMount() {
    const { id } = useParams();
    axios
      .get(`${process.env.MIX_REACT_APP_DOMAIN}/api/projects/${id}`)
      .then((res) => {
        this.setState({
          name: res.data.name,
          url: res.data.url,
          description: res.data.description,
        });
      })
      .catch((error) => {
        console.log(error);
      });
  }

  onChangeProjectName(e: any) {
    this.setState({ name: e.target.value });
  }

  onChangeProjectUrl(e: any) {
    this.setState({ url: e.target.value });
  }

  onChangeProjectDescription(e: any) {
    this.setState({ description: e.target.value });
  }

  onSubmit(e: any) {
    e.preventDefault();
    const { id } = useParams();

    const projectObject = {
      name: this.state.name,
      url: this.state.url,
      description: this.state.description,
    };

    axios
      .put(
        `${process.env.MIX_REACT_APP_DOMAIN}/api/projects/${id}`,
        projectObject
      )
      .then((res) => {
        Swal.fire(
          "Hoàn thành!",
          `Project ${res.data.project.name} đã cập nhật thành công`,
          "success"
        );
      })
      .catch((error) => {
        console.log(error);
      });

    // Redirect to Project List
    history.push("/project-listing");
  }

  render() {
    return (
      <div className="form-wrapper">
        <Form onSubmit={this.onSubmit}>
          <Form.Group controlId="Name">
            <Form.Label>Name</Form.Label>
            <Form.Control
              type="text"
              value={this.state.name}
              onChange={this.onChangeProjectName}
            />
          </Form.Group>

          <Form.Group controlId="Url">
            <Form.Label>Url</Form.Label>
            <Form.Control
              type="text"
              value={this.state.url}
              onChange={this.onChangeProjectUrl}
            />
          </Form.Group>

          <Form.Group controlId="Description">
            <Form.Label>Description</Form.Label>
            <Form.Control
              type="text"
              value={this.state.description}
              onChange={this.onChangeProjectDescription}
            />
          </Form.Group>

          <Button variant="danger" size="lg" type="submit">
            Update Project
          </Button>
        </Form>
      </div>
    );
  }
}
