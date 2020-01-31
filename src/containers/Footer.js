import React from "react";
import { Pane, Text } from "evergreen-ui";
export default class Footer extends React.Component {
  render() {
    return (
      <Pane
        height={32}
        width={"100%"}
        display="flex"
        justifyContent="center"
        alignItems="center"
        border="default"
      >
        <Text>Pane</Text>
      </Pane>
    );
  }
}
