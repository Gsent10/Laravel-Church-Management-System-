import MemberIndex from "./components/members/index";
import MemberCreate from "./components/members/create";
import MemberEdit from "./components/members/edit";
import DepartmentsIndex from "./components/departments/index";
import DepartmentsCreate from "./components/departments/create";
import DepartmentsEdit from "./components/departments/edit";
import CellsIndex from "./components/cells/index";
import CellsCreate from "./components/cells/create";
import CellsEdit from "./components/cells/edit";
import EventsIndex from "./components/events/index";
import EventsCreate from "./components/events/create";
import EventsEdit from "./components/events/edit";
import AttendancesIndex from "./components/attendances/index";
import AttendancesMark from "./components/attendances/mark";

export const routes= [
    {
        path: '/members',
        name: 'MemberIndex',
        component: MemberIndex
    },
    {
        path: '/members/create',
        name: 'MemberCreate',
        component: MemberCreate
    },
    {
        path: '/members/:id',
        name: 'MemberEdit',
        component: MemberEdit
    },
    {
        path: '/departments',
        name: 'DepartmentsIndex',
        component: DepartmentsIndex
    },
    {
        path: '/departments/create',
        name: 'DepartmentsCreate',
        component: DepartmentsCreate
    },
    {
        path: '/departments/:id',
        name: 'DepartmentsEdit',
        component: DepartmentsEdit
    },
    {
        path: '/cells',
        name: 'CellsIndex',
        component: CellsIndex
    },
    {
        path: '/cells/create',
        name: 'CellsCreate',
        component: CellsCreate
    },
    {
        path: '/cells/:id',
        name: 'CellsEdit',
        component: CellsEdit
    },
    {
        path: '/events',
        name: 'EventsIndex',
        component: EventsIndex
    },
    {
        path: '/events/create',
        name: 'EventsCreate',
        component: EventsCreate
    },
    {
        path: '/events/:id',
        name: 'EventsEdit',
        component: EventsEdit
    },
    {
        path: '/attendances',
        name: 'AttendancesIndex',
        component: AttendancesIndex
    },
    {
        path: '/attendances/:id',
        name: 'AttendancesMark',
        component: AttendancesMark
    },
];