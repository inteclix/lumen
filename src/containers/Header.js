import React from "react";
import {Pane, Text, Tab, TabNavigation, Heading, Avatar} from "evergreen-ui";
import {Route, withRouter, Link} from "react-router-dom";

class Header extends React.Component {
  render() {
    return (
      <Pane
        height={36}
        width={"100%"}
        display="flex"
        justifyContent="center"
        alignItems="center"
        border="default"
        elevation={1}
      >
        <Pane backgroundColor="#8190c9" borderRadius={15}
              display="flex" justifyContent="center" alignItems="center" width={150} height={30} marginLeft={10} marginRight={20}>
          <Heading color={"white"}>Jasmin School</Heading>
        </Pane>
        <TabNavigation flex={1}>
          <Tab key={1} id={1} isSelected={this.props.location.pathname === "/"}>
            <Link
              style={{
                textDecoration: "none",
                color:
                  this.props.location.pathname === "/" ? "#1070ca" : "#425A70"
              }}
              decoration="none"
              to="/"
            >
              Home
            </Link>
          </Tab>
          <Tab
            key={1}
            href="/modules"
            id={1}
            isSelected={this.props.location.pathname.startsWith("/modules")}
          >
            <Link
              style={{
                textDecoration: "none",
                color: this.props.location.pathname.startsWith("/modules")
                  ? "#1070ca"
                  : "#425A70"
              }}
              decoration="none"
              to="/modules"
            >
              Modules
            </Link>
          </Tab>
          <Tab
            key={1}
            id={1}
            isSelected={this.props.location.pathname.startsWith("/students")}
          >
            <Link
              style={{
                textDecoration: "none",
                color: this.props.location.pathname.startsWith("/students")
                  ? "#1070ca"
                  : "#425A70"
              }}
              decoration="none"
              to="/students"
            >
              Students
            </Link>
          </Tab>
        </TabNavigation>
          <Avatar marginRight={10} name={"Seddik Benzemame"} />
      </Pane>
    );
  }
}

export default withRouter(Header);
