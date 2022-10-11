import React from "react";
import Nav from "react-bootstrap/Nav";
import Navbar from "react-bootstrap/Navbar";
import NavDropdown from "react-bootstrap/esm/NavDropdown";
import Container from "react-bootstrap/Container";
import { Link } from "react-router-dom";

export default function () {
  return (
    <header className="App-header">
      <Navbar>
        <Container>
          <Navbar.Toggle aria-controls="basic-navbar-nav" />
          <Navbar.Brand>
            <Link to={"/create-project"} className="nav-link">
              Tôi thiết kế frontend site.
            </Link>
          </Navbar.Brand>

          <Nav className="justify-content-end">
            <Navbar.Collapse id="basic-navbar-nav">
              <Nav className="me-auto">
                <Link to={"/"} className="nav-link">
                  Home
                </Link>

                <NavDropdown title="Dropdown" id="basic-nav-dropdown">
                  <NavDropdown title="User" id="basic-nav-dropdown">
                    <NavDropdown.Item>
                      <Link to={"/user-creating"} className="nav-link">
                        User Creating
                      </Link>
                    </NavDropdown.Item>
                    <NavDropdown.Item>
                      <Link to={"/user-listing"} className="nav-link">
                        User Listing
                      </Link>
                    </NavDropdown.Item>
                  </NavDropdown>

                  <NavDropdown title="Project" id="basic-nav-dropdown">
                    <NavDropdown.Item>
                      <Link to={"/create-project"} className="nav-link">
                        Create Project
                      </Link>
                    </NavDropdown.Item>
                    <NavDropdown.Item>
                      <Link to={"/project-listing"} className="nav-link">
                        Projects List
                      </Link>
                    </NavDropdown.Item>
                  </NavDropdown>
                </NavDropdown>
              </Nav>
            </Navbar.Collapse>
          </Nav>
        </Container>
      </Navbar>
    </header>
  );
}
