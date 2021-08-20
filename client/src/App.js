import logo from './logo.svg';
import './App.css';
import Randomer from './components/Randomer';

function App() {
  return (
    <div className="App">
      <header className="App-header">
        <img src={logo} className="App-logo" alt="logo" />
        <p>
          React socket
        </p>

        <Randomer />

      </header>
    </div>
  );
}

export default App;
