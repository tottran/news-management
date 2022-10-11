import React, { Component } from "react";
import Form from "react-bootstrap/Form";
import Button from "react-bootstrap/Button";
import Row from "react-bootstrap/Row";
import Col from "react-bootstrap/Col";
import axios from "axios";
import ProjectsList from "./project-listing";
import Swal from "sweetalert2";

type Props = {};
type State = {
  name: string;
  description: string;
  url: string;
};

export default class CreateProject extends Component<Props, State> {
  constructor(props: Props) {
    super(props);

    // Setting up functions
    this.onChangeProjectName = this.onChangeProjectName.bind(this);
    this.onChangeProjectUrl = this.onChangeProjectUrl.bind(this);
    this.onChangeProjectDescription =
      this.onChangeProjectDescription.bind(this);
    this.onSubmit = this.onSubmit.bind(this);

    // Setting up state
    this.state = {
      name: "",
      description: "",
      url: "",
    };
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
    const project = {
      name: this.state.name,
      url: this.state.url,
      description: this.state.description,
    };
    if (!project.name && !project.url && !project.description) {
      Swal.fire("Thông báo!", "Vui lòng điền thông tin", "error");
    } else {
      axios
        .post(`${process.env.MIX_REACT_APP_DOMAIN}/api/projects/`, project)
        .then((res) => {
          Swal.fire("Hoàn thành!", "Project đã thêm thành công", "success");
        })
        .catch((e: any) => {
          Swal.fire("Thất bại!", "Thêm Project không thành công", "error");
        });

      this.setState({ name: "", url: "", description: "" });
    }
  }

  render() {
    return (
      <div className="form-wrapper">
        <Form onSubmit={this.onSubmit}>
          <Row>
            <Col>
              <Form.Group controlId="Name">
                <Form.Label>Name</Form.Label>
                <Form.Control
                  type="text"
                  value={this.state.name}
                  onChange={this.onChangeProjectName}
                />
              </Form.Group>
            </Col>

            <Col>
              <Form.Group controlId="Url">
                <Form.Label>Url</Form.Label>
                <Form.Control
                  type="text"
                  value={this.state.url}
                  onChange={this.onChangeProjectUrl}
                />
              </Form.Group>
            </Col>
          </Row>

          <Form.Group controlId="description">
            <Form.Label>Description</Form.Label>
            <Form.Control
              as="textarea"
              type="textarea"
              value={this.state.description}
              onChange={this.onChangeProjectDescription}
            />
          </Form.Group>

          <br></br>
          <Button variant="primary" size="lg" type="submit">
            Add Project
          </Button>
        </Form>
        <br></br>
        <br></br>

        <ProjectsList> </ProjectsList>
      </div>
    );
  }
}
