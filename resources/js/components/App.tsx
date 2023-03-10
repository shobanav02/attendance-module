import React from 'react';
import { UserOutlined, UploadOutlined } from '@ant-design/icons';
import { Button, MenuProps } from 'antd';
import { Breadcrumb, Layout, Menu, theme, Typography, Upload, message } from 'antd';
import ProTable, { ProColumns } from "@ant-design/pro-table";
import { useState, useEffect } from 'react';
import axios from 'axios'
import { getBase64 } from './fileReader';
const { Header, Content, Sider, Footer } = Layout;
const { Text } = Typography;


const items: MenuProps['items'] = [UserOutlined].map(
    (icon, index) => {
        const key = String(index + 1);

        return {
            key: `sub${key}`,
            icon: React.createElement(icon),
            label: `Attendance`,
        };
    },
);

const App = () => {
    const {
        token: { colorBgContainer },
    } = theme.useToken();

    const [fileList, setFileList] = useState([]);
    const [attendanceData, setAttendanceData] = useState([]);
    const [fileData, setFileData] = useState('');

    useEffect(() => {
        fetchAttendance();
    }, [])

    const fetchAttendance = async () => {
        await axios.get(`http://localhost:8000/api/attendance`).then(({ data }) => {
            const attendanceArray = data.map((item:any) => {
                return {
                    'name': item.employee.name,
                    'check_in': item.check_in ? item.check_in : 'N/A',
                    'check_out': item.check_out ? item.check_out : 'N/A',
                    'workHours': item.workedHours
                }


            });

            setAttendanceData(attendanceArray)
        })
    }
    const uploaderProps = {
        beforeUpload: (file: any) => {
            const isValidFormat = file.type === 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' || file.type === "application/vnd.ms-excel";
            if (!isValidFormat) {
                message.error("File format should be JPG or PDF")
            }
            return isValidFormat || Upload.LIST_IGNORE;
        },
        onChange({ file, fileList }) {

            try {
                getFile(file.originFileObj);

                const fileDataArray = {
                    fileName: file.name,
                    fileSize: file.size,
                    data: fileData.split(',')[1],
                };
                axios.post(`http://localhost:8000/api/attendance`, fileDataArray).then(({ data }) => {
                    message.success('File uploaded');
                });

            } catch (error) {
                message.error('Failed to upload');
            }
        }

    };

    const getFile = async (file:any) => {
        const data = await getBase64(file);
        setFileData(data);
    }
    const columns: ProColumns<any>[] = [
        {
            title: "Name",
            dataIndex: 'name'
        },
        {
            title: "Check In",
            dataIndex: 'check_in',
        },
        {
            title: "Check Out",
            dataIndex: 'check_out',
        },
        {
            title: "Total Working Hours",
            dataIndex: 'workHours',
        },

    ];

    return (
        
        <Layout>
            <Header style={{ backgroundColor: 'lightblue' }}>
                <div className="logo" />
                <Text>
                    Human Resource
                </Text>

            </Header>
            <Layout>
                <Sider width={200} style={{ background: colorBgContainer }}>
                    <Menu
                        mode="inline"
                        defaultSelectedKeys={['1']}
                        defaultOpenKeys={['sub1']}
                        style={{ height: '100%', borderRight: 0 }}
                        items={items}
                    />
                </Sider>
                <Layout style={{ padding: '0 24px 24px' }}>
                    <Breadcrumb style={{ margin: '16px 0' }}>
                        <Breadcrumb.Item>Home</Breadcrumb.Item>
                        <Breadcrumb.Item>Attendance</Breadcrumb.Item>
                    </Breadcrumb>
                    <Content
                        style={{
                            padding: 24,
                            margin: 0,
                            minHeight: 280,
                            background: colorBgContainer,
                        }}
                    >
                        <ProTable<any>
                            columns={columns}
                            rowKey="id"
                            dataSource={attendanceData}
                            search={false}
                            pagination={{
                                showSizeChanger: true,
                            }}
                            toolBarRender={() => [
                                <Upload {...uploaderProps} className="upload-btn">
                                    <Button style={{ borderRadius: 6 }} icon={<UploadOutlined />}>
                                        Upload Attendance
                                    </Button>

                                </Upload>
                            ]}

                        />
                    </Content>
                </Layout>
            </Layout>
            <Footer style={{ textAlign: 'center' }}>HR solution??2023 Created by Ant </Footer>

        </Layout>
    );
};

export default App;


