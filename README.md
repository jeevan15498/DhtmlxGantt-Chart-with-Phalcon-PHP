# DhtmlxGantt Chart with Phalcon PHP

* https://docs.dhtmlx.com/gantt/desktop__howtostart_php_slim4.html
* https://docs.dhtmlx.com/gantt/desktop__howtostart_php_slim4.html#step4loadingdata

## Simple Demo

```html
<script src="https://cdn.dhtmlx.com/gantt/edge/dhtmlxgantt.js"></script>
<link href="https://cdn.dhtmlx.com/gantt/edge/dhtmlxgantt.css" rel="stylesheet">

<div id="gantt_here" style='width:100%; height:100%;'></div>

<script type="text/javascript">
gantt.init("gantt_here");
</script>
```

## Parse Data

```js
var tasks = {
    data: [
        {
            id: 1, text: "Project #2", start_date: "01-04-2018", duration: 18, order: 10,
            progress: 0.4, open: true
        },
        {
            id: 2, text: "Task #1", start_date: "02-04-2018", duration: 8, order: 10,
            progress: 0.6, parent: 1
        },
        {
            id: 3, text: "Task #2", start_date: "11-04-2018", duration: 8, order: 20,
            progress: 0.6, parent: 1
        }
    ],
    links: [
        {id: 1, source: 1, target: 2, type: "1"},
        {id: 2, source: 2, target: 3, type: "0"}
    ]
};
gantt.init("gantt_here");

gantt.parse(tasks); // Load JSON Data
// gantt.load("../common/data.json", "json"); // Load JSON File Data, https://docs.dhtmlx.com/gantt/samples/common/data.json?dhxr1582262820740=1
```

## Global Settings

```js
gantt.config.xml_date = "%Y-%m-%d %H:%i:%s";
```

## Database Table

```sql
CREATE TABLE `gantt_links` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `source` int(11) NOT NULL,
  `target` int(11) NOT NULL,
  `type` varchar(1) NOT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE `gantt_tasks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `text` varchar(255) NOT NULL,
  `start_date` datetime NOT NULL,
  `duration` int(11) NOT NULL,
  `progress` float NOT NULL,
  `parent` int(11) NOT NULL,
  PRIMARY KEY (`id`)
);
```

* Temp Data

```sql
INSERT INTO `gantt_tasks` VALUES ('1', 'Project #1', '2020-03-31 00:00:00','4', '0.8', '0');
INSERT INTO `gantt_tasks` VALUES ('2', 'Task #1', '2020-03-31 00:00:00','3', '0.5', '1');
INSERT INTO `gantt_tasks` VALUES ('3', 'Task #2', '2020-04-01 00:00:00','2', '0.7', '1');
INSERT INTO `gantt_tasks` VALUES ('4', 'Task #3', '2020-04-02 00:00:00','2', '0', '1');
INSERT INTO `gantt_tasks` VALUES ('5', 'Task #1.1', '2020-04-03 00:00:00','3', '0.34', '2');
INSERT INTO `gantt_tasks` VALUES ('6', 'Task #1.2', '2020-04-03 13:22:17','2', '0.5', '2');
INSERT INTO `gantt_tasks` VALUES ('7', 'Task #2.1', '2020-04-04 00:00:00''3', '0.2', '3');
INSERT INTO `gantt_tasks` VALUES ('8', 'Task #2.2', '2020-04-05 00:00:00','2', '0.9', '3');
```

# [Setup](Step_up.md)