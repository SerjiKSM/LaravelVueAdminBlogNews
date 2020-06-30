import AddCategory from './components/admin/news-category/New'
import CategoryList from './components/admin/news-category/List'
import EditCategory from './components/admin/news-category/Edit'
import NewsList from './components/admin/news/List'
import AddNews from './components/admin/news/New'
import EditNews from './components/admin/news/Edit'
import ListNewsByCategory from './components/admin/news/ListNewsByCategory'
import News from './components/admin/news/News'

export const routes = [
    {
        path:'/add-category',
        name: 'add.category',
        component:AddCategory
    },
    {
        path:'/category-list',
        name: 'categories.list',
        component:CategoryList
    },
    {
        path:'/edit-category/:categoryid',
        name: 'category.edit',
        component:EditCategory
    },


    {
        path:'/add-news',
        name: 'add.news',
        component:AddNews
    },
    {
        path:'/news-list',
        name: 'news.list',
        component:NewsList
    },
    {
        path:'/edit-news/:newsid',
        name: 'news.edit',
        component:EditNews
    },
    {
        path:'/news-by-category/:categoryid',
        component:ListNewsByCategory
    },
    {
        path:'/news/:newsid',
        component:News
    },

];
