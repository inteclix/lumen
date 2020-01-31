import React from "react";
import { filter } from "fuzzaldrin-plus";
import {
  Table,
  Popover,
  Position,
  Menu,
  Avatar,
  Text,
  IconButton,
  TextDropdownButton,
  SideSheet,
  Paragraph,
  Heading
  // eslint-disable-next-line import/no-unresolved
} from "evergreen-ui";
import profiles from "./modules.json"; // eslint-disable-line import/extensions

function capitalize(string) {
  return string.charAt(0).toUpperCase() + string.slice(1).toLowerCase();
}

const Order = {
  NONE: "NONE",
  ASC: "ASC",
  DESC: "DESC"
};

export default class Modules extends React.Component {
  constructor(props) {
    super(props);

    this.state = {
      searchQuery: "",
      orderedColumn: 1,
      ordering: Order.NONE,
      column2Show: "day",
      isShownAddSide: false
    };
  }

  sort = profiles => {
    const { ordering, orderedColumn } = this.state;
    // Return if there's no ordering.
    if (ordering === Order.NONE) return profiles;

    // Get the property to sort each profile on.
    // By default use the `name` property.
    let propKey = "name";
    // The second column is dynamic.
    if (orderedColumn === 2) propKey = this.state.column2Show;
    // The third column is fixed to the `description` property.
    if (orderedColumn === 3) propKey = "time";

    return profiles.sort((a, b) => {
      let aValue = a[propKey];
      let bValue = b[propKey];

      // Parse money as a number.
      const isMoney = aValue.indexOf("$") === 0;

      if (isMoney) {
        aValue = Number(aValue.substr(1));
        bValue = Number(bValue.substr(1));
      }

      // Support string comparison
      const sortTable = { true: 1, false: -1 };

      // Order ascending (Order.ASC)
      if (this.state.ordering === Order.ASC) {
        return aValue === bValue ? 0 : sortTable[aValue > bValue];
      }

      // Order descending (Order.DESC)
      return bValue === aValue ? 0 : sortTable[bValue > aValue];
    });
  };

  // Filter the profiles based on the name property.
  filter = profiles => {
    const searchQuery = this.state.searchQuery.trim();

    // If the searchQuery is empty, return the profiles as is.
    if (searchQuery.length === 0) return profiles;

    return profiles.filter(profile => {
      // Use the filter from fuzzaldrin-plus to filter by name.
      const result = filter([profile.name], searchQuery);
      return result.length === 1;
    });
  };

  getIconForOrder = order => {
    switch (order) {
      case Order.ASC:
        return "arrow-up";
      case Order.DESC:
        return "arrow-down";
      default:
        return "caret-down";
    }
  };

  handleFilterChange = value => {
    this.setState({ searchQuery: value });
  };

  renderValueTableHeaderCell = () => {
    return (
      <Table.HeaderCell>
        <Popover
          position={Position.BOTTOM_LEFT}
          content={({ close }) => (
            <Menu>
              <Menu.OptionsGroup
                title="Order"
                options={[
                  { label: "Ascending", value: Order.ASC },
                  { label: "Descending", value: Order.DESC }
                ]}
                selected={
                  this.state.orderedColumn === 2 ? this.state.ordering : null
                }
                onChange={value => {
                  this.setState({
                    orderedColumn: 2,
                    ordering: value
                  });
                  // Close the popover when you select a value.
                  close();
                }}
              />
            </Menu>
          )}
        >
          <TextDropdownButton
            icon={
              this.state.orderedColumn === 2
                ? this.getIconForOrder(this.state.ordering)
                : "caret-down"
            }
          >
            {capitalize(this.state.column2Show)}
          </TextDropdownButton>
        </Popover>
      </Table.HeaderCell>
    );
  };

  renderDescriptionTableHeaderCell = () => {
    return (
      <Table.TextHeaderCell>
        <Popover
          position={Position.BOTTOM_LEFT}
          content={({ close }) => (
            <Menu>
              <Menu.OptionsGroup
                title="Order"
                options={[
                  { label: "Ascending", value: Order.ASC },
                  { label: "Descending", value: Order.DESC }
                ]}
                selected={
                  this.state.orderedColumn === 3 ? this.state.ordering : null
                }
                onChange={value => {
                  this.setState({
                    orderedColumn: 3,
                    ordering: value
                  });
                  // Close the popover when you select a value.
                  close();
                }}
              />
            </Menu>
          )}
        >
          <TextDropdownButton
            icon={
              this.state.orderedColumn === 3
                ? this.getIconForOrder(this.state.ordering)
                : "caret-down"
            }
          >
              Description
          </TextDropdownButton>
        </Popover>
      </Table.TextHeaderCell>
    );
  };

  renderRowMenu = () => {
    return (
      <Menu>
        <Menu.Group>
          <Menu.Item>Share...</Menu.Item>
          <Menu.Item>Move...</Menu.Item>
          <Menu.Item secondaryText="⌘R">Rename...</Menu.Item>
        </Menu.Group>
        <Menu.Divider />
        <Menu.Group>
          <Menu.Item intent="danger">Delete...</Menu.Item>
        </Menu.Group>
      </Menu>
    );
  };

  renderRow = ({ profile }) => {
    return (
      <Table.Row key={profile.id}>
        <Table.Cell display="flex" alignItems="center">
          <Avatar name={profile.name} />
          <Text marginLeft={8} size={300} fontWeight={500}>
            {profile.name}
          </Text>
        </Table.Cell>
        <Table.TextCell>{profile[this.state.column2Show]}</Table.TextCell>
        <Table.TextCell>{profile.time}</Table.TextCell>
        <Table.Cell width={48} flex="none">
          <Popover
            content={this.renderRowMenu}
            position={Position.BOTTOM_RIGHT}
          >
            <IconButton icon="more" height={24} appearance="minimal" />
          </Popover>
        </Table.Cell>
      </Table.Row>
    );
  };

  renderAddSide = () => {
    return (
      <SideSheet
        width={450}
        isShown={this.state.isShownAddSide}
        onCloseComplete={() => this.setState({ isShownAddSide: false })}
      >
        <Paragraph margin={40}>Basic Example</Paragraph>
      </SideSheet>
    );
  };

  render() {
    const items = this.filter(this.sort(profiles));
    return (
      <Table display="flex" flexDirection="column" flex={1} border>
        <Table.Head>
          {this.renderAddSide()}
          <IconButton
            onClick={() => this.setState({ isShownAddSide: true })}
            appearance="minimal"
            icon="add"
            iconSize={16}
          />
          <Table.SearchHeaderCell
            onChange={this.handleFilterChange}
            value={this.state.searchQuery}
          />
          {this.renderValueTableHeaderCell()}
          {this.renderDescriptionTableHeaderCell()}
          <Table.HeaderCell width={48} flex="none" />
        </Table.Head>
        <Table.VirtualBody>
          {items.map(item => this.renderRow({ profile: item }))}
        </Table.VirtualBody>
      </Table>
    );
  }
}
