import React from "react";
import { Pane, Text } from "evergreen-ui";
export default class Home extends React.Component {
  render() {
    return (
      <Pane
        flex={1}
        display="flex"
        justifyContent="center"
        alignItems="center"
        border="default"
      >
        <img src={require("../imgs/jasmin-logo.png")} height={400} />
      </Pane>
    );
  }
}
