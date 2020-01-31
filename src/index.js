import React from "react";
import ReactDOM from "react-dom";
import { BrowserRouter, Route } from "react-router-dom";
import {
  TextInputField,
  Text,
  Pane,
  Heading,
  Button,
  Link
} from "evergreen-ui";

import AdvancedTable from "./AdvancedTable";
import Header from "./containers/Header";
import Footer from "./containers/Footer";

import Login from "./containers/Login";
import Home from "./containers/Home";
import Modules from "./containers/Modules";
import Students from "./containers/Students";
function App() {
  return (
    <BrowserRouter>
      <Pane display="flex" flex={1} width="100%" flexDirection="column">
        <Header />
        <Pane paddingTop={5} flex={1} display="flex" flexDirection="column">
          <Route path={"/"} exact component={Home} />
          <Route path={"/students"} component={Students} />
          <Route path={"/modules"} component={Modules} />
        </Pane>
        <Footer />
      </Pane>
    </BrowserRouter>
  );
}

const rootElement = document.getElementById("root");
ReactDOM.render(<App />, rootElement);
